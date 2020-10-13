import Vue from 'vue'

export function getSelf() {
  return Vue.axios.get(`/api/me`)
    .then((response) => {
      return response.data
    })
}
