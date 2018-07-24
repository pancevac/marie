<template>
  <div class="modal" :data-open='open' v-on:click='hide'>
    <div class="modal_surface" v-on:click.stop>
      <slot></slot>
    </div>
  </div>
</template>

<script>
import toggler from '../mixins/toggler';

export default {
  mixins: [toggler],

  mounted() {
    this.$root.$on('show:modal', this.show);
    window.addEventListener('keyup', this.onKeyUp);
  },

  destroyed() {
    this.$root.$off('show:modal', this.show);
    window.removeEventListener('keyup', this.onKeyUp);
  },
}
</script>
