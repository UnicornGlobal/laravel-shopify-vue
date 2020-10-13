import { Loading } from '@shopify/app-bridge/actions';

export default {
  install(Vue) {
    const loading = Loading.create(Vue.shopifyApp)
    Vue.prototype.$actions.loading = loading
  }
}
