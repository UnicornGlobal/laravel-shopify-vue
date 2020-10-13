import LoadingAction from './loading'
import ToastAction from './toast'
import ErrorAction from './error'
import ModalAction from './modal'
import TitalBarAction from './titlebar'

export default {
  install(Vue, shopifyApp) {
    Vue.prototype.$actions = []

    Vue.shopifyApp = shopifyApp

    Vue.use(LoadingAction)
    Vue.use(ToastAction)
    Vue.use(ErrorAction)
    Vue.use(ModalAction)
    Vue.use(TitalBarAction)
  }
}
