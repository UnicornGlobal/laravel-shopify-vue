<template>
  <router-view></router-view>
</template>

<script>

import { Loading } from '@shopify/app-bridge/actions'

export default {
  mounted() {
    const loaderElement = document.getElementById('initialLoader')
    loaderElement.style.display = 'none'
  }
}
</script>
