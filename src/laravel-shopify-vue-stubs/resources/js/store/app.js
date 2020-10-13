import configuration from '../config'
import shop from './shop'
import token from './token'

export default {
  namespaced: true,
  state: {
    ...shop.state,
    ...token.state,
    loading: true,
    config: configuration
  },
  mutations: {
    ...shop.mutations,
    ...token.mutations,
    loading(state, loading) {
      state.loading = loading
    },
    config(state, config) {
      state.config = config
    }
  },
  getters: {
    ...shop.getters,
    ...token.getters,
    loading(state) {
      return state.loading
    },
    config(state, _getters) {
      return state.config
    }
  }
}
