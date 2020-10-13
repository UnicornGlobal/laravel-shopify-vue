export default [
  {
    path: '/',
    component: require('../Base.vue').default,
    children: [
      {
        path: '/',
        component: require('../pages/Example.vue').default,
        meta: {
          main: true,
          name: 'Example'
        }
      }
    ]
  },
]
