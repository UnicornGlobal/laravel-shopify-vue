import { Error } from '@shopify/app-bridge/actions'

export default {
  install(Vue) {
    const handleError = (error) => {
      Vue.prototype.$actions.toast.create(Vue.shopifyApp, {
        message: error.response.data.message,
        duration: 5000,
        isError: true
      }).dispatch(Vue.prototype.$actions.toast.Action.SHOW)

      return Promise.reject(error)
    }

    Vue.prototype.$actions.error = Error

    Vue.shopifyApp.error((data) => {
      const { type, action, message } = data
      // TODO
    })

    // Setup error handling
    Vue.axios.interceptors.response.use((response) => {
      return response;
    }, (error) => {
      return handleError(error)
    })
  }
}
