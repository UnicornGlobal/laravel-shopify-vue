export default {
  namespaced: true,
  state: {
    token: null
  },
  mutations: {
    token(state, token) {
      state.token = token
    }
  },
  getters: {
    token(state) {
      return state.token
    }
  }
}
