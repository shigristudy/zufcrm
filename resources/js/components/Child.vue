<template>
<!-- BEGIN: Content-->
    
        <transition name="page" mode="out-in">
          <slot>
            <router-view />
          </slot>
        </transition>
       
    <!-- END: Content-->
  
</template>

<script>
export default {
  name: 'Child'
}
</script>
