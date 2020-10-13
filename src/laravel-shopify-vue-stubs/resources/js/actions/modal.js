import { Modal } from '@shopify/app-bridge/actions';

export default {
  install(Vue) {
    Vue.prototype.$actions.modal = Modal
  }
}
