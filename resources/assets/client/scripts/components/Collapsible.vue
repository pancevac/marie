<template>
  <component v-bind:is='as' v-bind:style='{display: (hidden ? "none" : "")}'>
    <slot></slot>
  </component>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },

    as: {
      type: String,
      default: 'div',
    },

    visible: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      hidden: !this.visible,
    };
  },

  mounted() {
    this.$root.$on(`toggle:${this.name}`, this.toggle);
  },

  destroyed() {
    this.$root.$off(`toggle:${this.name}`, this.toggle);
  },

  methods: {
    toggle() {
      this.hidden = !this.hidden;
    },
  },
}
</script>

