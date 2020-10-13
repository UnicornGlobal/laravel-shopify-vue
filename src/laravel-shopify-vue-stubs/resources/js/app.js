import '@unicorns/polaris-vue/lib/polaris-vue.css';

import Vue from 'vue';
import VueRouter from 'vue-router';
import PolarisVue from '@unicorns/polaris-vue';

import VueAxios from 'vue-axios'
import axios from 'axios'

import createApp from '@shopify/app-bridge';
import { getSessionToken } from '@shopify/app-bridge-utils'
import { Redirect, History } from '@shopify/app-bridge/actions';

import ShopifyActions from './actions'

import router from './router';
import store from './store'
import config from './config'

Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(VueAxios, axios)
Vue.use(PolarisVue);

const key = document.getElementById('shop_key').innerText
const name = document.getElementById('shop_name').innerText

// If this is loaded outside of the iframe without any query vars
// send the user to the install page.
if (!name) {
  window.top.location.href = process.env.MIX_SHOPIFY_APP_STORE_PAGE;
}

const shopifyApp = createApp({
  apiKey: key,
  shopOrigin: name,
  forceRedirect: true,
});

Vue.use(ShopifyActions, shopifyApp)

const start = () => {
  const sessionToken = getSessionToken(shopifyApp).then((token) => {
    Vue.axios.defaults.headers.post['Content-Type'] = 'application/json'
    Vue.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
    Vue.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

    store.commit('app/token', token)
  })

  /* eslint-disable no-new */
  const app = new Vue({
    el: '#app',
    router,
    store,
    render: function (createElement) {
      return createElement('router-view')
    }
  })

  window.Vue = app

  const history = History.create(shopifyApp);
  history.dispatch(History.Action.PUSH, `${window.location.pathname}`);

  // Take over navigation tabs
  shopifyApp.subscribe(Redirect.ActionType.APP, function(redirectData) {
    app.$router.push(redirectData.path)
  });

  store.commit('app/shop', name);

  // Keep the token fresh every 30 seconds
  app.tokenRefresher = setInterval(() => {
    getSessionToken(shopifyApp).then((token) => {
      console.log(token)
      Vue.axios.defaults.headers.post['Content-Type'] = 'application/json'
      Vue.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
      Vue.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

      store.commit('app/token', token)
    })
  }, 30000)
}

window.shopifyApp = shopifyApp

window.onload = () => {
  start()
}
