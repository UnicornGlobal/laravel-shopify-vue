import Vue from 'vue'

export function getPlans() {
  return Vue.axios.get(`/api/plans`)
    .then((response) => {
      return response.data
    })
}
