<template>
  <div class="app-content content" v-bind:class="cravings">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <child />
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  },
  computed: {
    cravings: function() {
      return (this.$route.name == 'login') ? 'guest_pages' : '';
    }
  }
}
</script>
<style>
.guest_pages{
  margin-left: unset !important;
  position: absolute;
  top: 100px;
  left: 0;
  right: 0;
  bottom: 0;  
}

</style>