import { Toast } from '@shopify/app-bridge/actions';

export default {
  install(Vue) {
    Vue.prototype.$actions.toast = Toast
  }
}
