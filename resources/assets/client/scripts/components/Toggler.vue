<template>
  <button :class='className' v-on:click='dispatch'>
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    className: {
      type: String,
      default: '',
    },

    event: {
      type: String,
      required: true,
    },
  },

  methods: {
    dispatch(evt) {
      this.$root.$emit(this.event);
    },
  },
}
</script>

