<template>
  <div v-if="successful" class="alert alert-success alert-dismissible" role="alert">
    <button v-if="dismissible" type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

    <slot>
      <div v-html="message"/>
    </slot>
  </div>
</template>

<script>
import Alert from './Alert'

export default {
  name: 'success-alert',

  extends: Alert,

  props: {
    message: { type: String, default: '' },
    successful: { type: Boolean, default: false }
  }
}
</script>
