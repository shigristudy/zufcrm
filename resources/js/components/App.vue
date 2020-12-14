<template>
  <div id="app">
    <loading ref="loading" />
    <NavigationBar v-if="user"></NavigationBar>
    <SideBarMenu v-if="user"></SideBarMenu>
    <transition name="page" mode="out-in">
      <component :is="layout" v-if="layout" />
    </transition>
  </div>
</template>

<script>
import Loading from './Loading'
import NavigationBar from './../pages/layout/Navbar'
import SideBarMenu from './../pages/layout/Menu'
import { mapGetters } from 'vuex'
// Load layout components dynamically.
const requireContext = require.context('~/layouts', false, /.*\.vue$/)

const layouts = requireContext.keys()
  .map(file =>
    [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)]
  )
  .reduce((components, [name, component]) => {
    components[name] = component.default || component
    return components
  }, {})

export default {
  el: '#app',

  components: {
    Loading,
    NavigationBar,
    SideBarMenu
  },

  data: () => ({
    layout: null,
    defaultLayout: 'default'
  }),

  metaInfo () {
    const { appName } = window.config

    return {
      title: appName,
      titleTemplate: `%s · ${appName}`
    }
  },

  mounted () {
    this.$loading = this.$refs.loading
  },

  // created(){
  //   this.$nextTick(function(){
  //     jQuery('.main-menu').data('scroll-to-active', 'false');
  //   })
  // },

  methods: {
    /**
     * Set the application layout.
     *
     * @param {String} layout
     */
    setLayout (layout) {
      if (!layout || !layouts[layout]) {
        layout = this.defaultLayout
      }

      this.layout = layouts[layout]
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
}
</script>
