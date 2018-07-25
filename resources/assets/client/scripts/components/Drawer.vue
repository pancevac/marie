<template>
  <aside class="drawer" :data-open='open' v-on:click='hide'>
    <div class="drawer_drawer" v-on:click.stop>
      <slot></slot>
    </div>
  </aside>
</template>

<script>
import toggler from '../mixins/toggler';

export default {
  mixins: [toggler],

  mounted() {
    this.$root.$on('show:drawer', this.show);
    this.$root.$on('hide:drawer', this.hide);
    window.addEventListener('keyup', this.onKeyUp);
  },

  destroyed() {
    this.$root.$off('show:drawer', this.show);
    this.$root.$off('hide:drawer', this.hide);
    window.removeEventListener('keyup', this.onKeyUp);
  },
}
</script>
