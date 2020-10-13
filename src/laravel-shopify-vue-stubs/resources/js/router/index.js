import Vue from 'vue'
import Router from 'vue-router'

import appRoutes from './routes'

const router = new Router({
  mode: 'history',
  routes: appRoutes
})

export default router
