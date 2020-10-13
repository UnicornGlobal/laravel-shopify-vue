<template>
  <div>
    <polaris-layout>
      <polaris-layout-section>
        <polaris-card
          sectioned
          title="Example Card">
          </span>Welcome to {{ app }}.</span>
        </polaris-card>
      </polaris-layout-section>
      <polaris-layout-section>
        <polaris-account-connection
          title="Connected to Shopify"
          :action="{ content: 'View Current Token', onAction: showToken }"
          :details="store"
          connected
          >
          <p>
          You can view the
          <polaris-link url="https://github.com" external>Documentation</polaris-link>.
          Look at the source code for more information.
          </p>
        </polaris-account-connection>

        <polaris-card title="API Interaction Example" sectioned>
          <p>The loading action at the top of the page will be triggered</p>
          <polaris-button-group>
            <polaris-button slot="1" @click="me" icon="checkmark">User Details</polaris-button>
            <polaris-button slot="2" @click="plans">Available Plans</polaris-button>
          </polaris-button-group>
          <polaris-scrollable
            shadow
            :style="{ height: '100px' }">
            <pre>{{ output }}</pre>
          </polaris-scrollable>
        </polaris-card>
      </polaris-layout-section>
    </polaris-layout>
    <polaris-footer-help>
      Made By
      <polaris-link url="https://github.com/UnicornGlobal" external>Unicorn Global</polaris-link>.
    </polaris-footer-help>
    <br />
    <example-component></example-component>
  </div>
</template>

<script>
import { Loading } from '@shopify/app-bridge/actions'

import { getSelf } from '../api/user'
import { getPlans } from '../api/plans'

import ExampleComponent from '../components/ExampleComponent'

export default {
  mounted() {
    this.$actions.loading.dispatch(Loading.Action.STOP)
    // TODO put into loader subscription
    this.$store.commit('app/loading', false)

    this.$actions.titlebar.create(shopifyApp, {
      title: 'Example Page'
    })
  },
  data() {
    return {
      output: 'Choose an action to interact with the API. The raw response data will be output here.'
    }
  },
  methods: {
    me() {
      this.$actions.loading.dispatch(Loading.Action.START)
      this.output = 'Loading /api/me'

      getSelf().then(result => {
        this.output = result
        this.$actions.loading.dispatch(Loading.Action.STOP)
      })
    },
    plans() {
      this.$actions.loading.dispatch(Loading.Action.START)
      this.output = 'Loading /api/plans'

      getPlans().then(result => {
        this.output = result
        this.$actions.loading.dispatch(Loading.Action.STOP)
      })
    },
    showToken() {
      this.$actions.modal.create(shopifyApp, {
        title: 'Current Token',
        message: this.$store.getters['app/token']
      }).dispatch(this.$actions.modal.Action.OPEN)
    }
  },
  computed: {
    store() {
      return this.$store.getters['app/shop']
    },
    app() {
      return this.$store.getters['app/config'].name
    },
    token() {
      return this.$store.getters['app/token']
    }
  }
}
</script>
