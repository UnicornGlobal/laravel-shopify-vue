export default {
  namespaced: true,
  state: {
    shop: null
  },
  mutations: {
    shop(state, shop) {
      state.shop = shop
    }
  },
  getters: {
    shop(state) {
      return state.shop
    }
  }
}
