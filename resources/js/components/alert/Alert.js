export default {
  props: {
    dismissible: {
      type: Boolean,
      default: true
    }
  },

  methods: {
    dismiss () {
      if (this.dismissible) {
        this.successful = false
      }
    }
  }
}
