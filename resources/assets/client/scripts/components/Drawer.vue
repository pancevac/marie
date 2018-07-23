<template>
  <aside class="drawer" :data-open='open' v-on:click='hide'>
    <div class="drawer_drawer" v-on:click.stop>
      <slot></slot>
    </div>
  </aside>
</template>

<script>
export default {
  data() {
    return {
      open: false,
    };
  },

  methods: {
    show() {
      this.open = true;
    },

    hide() {
      this.open = false;
    },

    onKeyUp(evt) {
      if (evt.keyCode === 27 && this.open) {
        this.hide();
      }
    },
  },

  mounted() {
    this.$root.$on('show:drawer', this.show);
    window.addEventListener('keyup', this.onKeyUp);
  },

  destroyed() {
    this.$root.$off('show:drawer', this.show);
    window.removeEventListener('keyup', this.onKeyUp);
  },
}
</script>

<style scoped>
  .drawer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    contain: strict;
    overflow: hidden;
    z-index: 100;
    pointer-events: none;
  }

  .drawer[data-open] {
    pointer-events: auto;
  }

  .drawer_drawer {
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100% - 56px);
    max-width: 320px;
    height: 100%;
    background-color: #212121;
    transform: translateX(-102%);
    transition: transform .21s .06s cubic-bezier(.4, 0, .4, 1);
    will-change: transform;
  }

  .drawer[data-open] .drawer_drawer {
    transform: translateX(0);
  }

  .drawer_drawer::after {
    position: absolute;
    top: 0;
    right: 0;
    width: 2px;
    height: 100%;
    content: "";
    background-color: #FFF;
    opacity: .5;
  }
</style>

