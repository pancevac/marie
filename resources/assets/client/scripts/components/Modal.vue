<template>
  <div class="modal" :data-open='open' v-on:click='hide'>
    <div class="modal_surface" v-on:click.stop>
      <slot></slot>
    </div>
  </div>
</template>

<script>
import hider from './hider';

export default {
  mixins: [hider],

  mounted() {
    this.$root.$on('show:modal', this.show);
  },

  destroyed() {
    this.$root.$off('show:modal', this.show);
  },
}
</script>
