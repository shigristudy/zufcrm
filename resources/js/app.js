import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'

import Multiselect from 'vue-multiselect'

// register globally
Vue.component('multiselect', Multiselect)


import VueSweetalert2 from 'vue-sweetalert2';
 
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

import common from '~/common'
Vue.mixin(common)

Vue.config.productionTip = false
window.axios = require('axios');
/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
