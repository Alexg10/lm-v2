export default {
  mode: 'spa',
  /*
  ** Headers of the page
  */
  head: {
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#fff' },
  /*
  ** Global CSS
  */
  css: [
    'swiper/dist/css/swiper.css',
    'slick-carousel/slick/slick.css',
    '@/assets/scss/styles.scss'
  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    {src: '~/plugins/slick.js', ssr: false },
    {src: '~/plugins/vue-scrollmagic.js', ssr: false},
    {src: '~/plugins/gsap.js', ssr: false},
    {src: '~/plugins/cursor.js', ssr: false},
    {src: '~/plugins/touch.js', ssr: false},
    {src: '~/plugins/device-detector.js', ssr: false},
    {src: '~/plugins/ga.js', mode: 'client'}


  ],
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    '@nuxtjs/google-analytics'
  ],
  googleAnalytics: {
    id: 'UA-37342679-6'
  },
  /*
  ** Nuxt.js modules
  */
  modules: [
      '@nuxtjs/apollo',
      'vue-scrollto/nuxt'
  ],
  apollo: {
    clientConfigs: {
      default: {
        httpEndpoint: 'http://localhost:8888/lm/lm_wordpress/graphql'
      }
    }
  },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend (config, ctx) {
    }
  },
  server: {
    host: 'localhost'
  }
  // modules: ['@nuxtjs/style-resources'],
  // styleResources: {
  //   scss: [
  //     '~assets/scss/_variables.scss' // use underscore "_" & also file extension ".scss"
  //   ]
  // }
}
