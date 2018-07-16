<template>
  <div class="wrap" ref="wrap">
    <div class="host"
      v-on:touchstart='onTouchStart'
      v-on:mousedown='onTouchStart'
      v-bind:style='{transform: translateX}'
    >
      <div class="track" ref="track">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      screenX: 0,
    };
  },
  
  computed: {
    translateX() {
      return `translateX(${this.screenX}px)`;
    },
  },

  mounted() {
    this.init();
    window.addEventListener('resize', this.onResize);
  },

  destroyed() {
    window.removeEventListener('resize', this.onResize);
  },

  methods: {
    /**
     * Sets everything up.
     */
    init() {
      const width = this.$refs.track.getBoundingClientRect().width;
      const clientWidth = this.$refs.wrap.getBoundingClientRect().width;

      this.isTouching = false;
      this.delta = 0;
      this.currentX = 0;
      this.min = 0;
      if (width > clientWidth) {
        this.min = -(width - clientWidth);
      }
      // reset state
      this.screenX = 0;
    },

    /**
     * Touchstart/mousedown event handler.
     */
    onTouchStart(evt) {
      evt.preventDefault();
      this.isTouching = true;
      this.delta = 0;
      this.startX = evt.pageX || evt.touches[0].pageX;
      this.addEventListeners();
      window.requestAnimationFrame(this.update);
    },

    /**
     * Touchmove, mousemove event handler.
     */
    onTouchMove(evt) {
      this.delta = (evt.pageX || evt.touches[0].pageX) - this.startX;
    },

    /**
     * Touchend/touchcancel/mouseup event handler.
     */
    onTouchEnd(evt) {
      this.isTouching = false;
      this.removeEventListeners();
    },

    /**
     * Responds to user gestures and updates the state accordingly.
     */
    update() {
      let screenX = this.delta + this.currentX;
      const x = Math.min(Math.max(this.min, screenX), 0);
      this.screenX = x;

      if (this.isTouching) {
        window.requestAnimationFrame(this.update);
        return;
      }

      // update the state for re-render.
      this.currentX = x;
    },

    /**
     * Resize event handler. Fires after the resize has finished.
     * https://css-tricks.com/snippets/jquery/done-resizing-event/
     */
    onResize(evt) {
      clearTimeout(this.resizeTimer);
      this.resizeTimer = setTimeout(() => {
        this.init();
      }, 250);
    },

    /**
     * Convinience method for attaching event handlers to the
     * document object. Fires on touchstart
     */
    addEventListeners() {
      // mouse events
      document.addEventListener('mousemove', this.onTouchMove);
      document.addEventListener('mouseup', this.onTouchEnd);
      // touch events
      document.addEventListener('touchmove', this.onTouchMove);
      document.addEventListener('touchend', this.onTouchEnd);
      document.addEventListener('touchcancel', this.onTouchEnd);
    },

    /**
     * Convinience method for detaching event listeners from the
     * docuement object. Fires on touchend.
     */
    removeEventListeners() {
      document.removeEventListener('mousemove', this.onTouchMove);
      document.removeEventListener('mouseup', this.onTouchEnd);
      document.removeEventListener('touchmove', this.onTouchMove);
      document.removeEventListener('touchend', this.onTouchEnd);
      document.removeEventListener('touchcancel', this.onTouchEnd);
    },
  },
}
</script>

<style scoped>
  .host {
    display: block;
    white-space: nowrap;
    overflow-x: visible;
    transform: translateX(0);
    will-change: transform;
    font-size: 0;
  }

  .wrap {
    overflow: hidden;
  }

  .track {
    display: inline-block;
    overflow: hidden;
    font-size: initial;
  }

  .track > * {
    display: inline-block;
  }
</style>
