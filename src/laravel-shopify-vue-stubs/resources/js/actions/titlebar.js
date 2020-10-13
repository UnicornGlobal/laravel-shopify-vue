import { TitleBar } from '@shopify/app-bridge/actions';

export default {
  install(Vue) {
    Vue.prototype.$actions.titlebar = TitleBar
  }
}
