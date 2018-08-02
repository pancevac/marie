<template>
  <component v-bind:is='as' v-on:click='dispatch'>
    <slot></slot>
  </component>
</template>

<script>
export default {
  props: {
    as: {
      type: String,
      default: 'button',
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

