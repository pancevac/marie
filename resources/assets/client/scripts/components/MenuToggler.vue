<template>
  <button class="icon-btn flex-shrink-0" v-on:click='showDrawer'>
    <svg class="icon" role="presentation" title="Toggle navigation">
      <use xlink:href="#icon_menu"></use>
    </svg>
  </button>
</template>

<script>
export default {
  methods: {
    showDrawer() {
      this.$root.$emit('show-drawer');
    },
  }
}
</script>
