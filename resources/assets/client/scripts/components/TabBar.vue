<template>
  <div class="tab-bar-wrap" ref="wrap">
    <div class="tab-bar"
      v-on:touchstart='onTouchStart'
      v-on:mousedown='onTouchStart'
      v-on:click='onClick'
      v-bind:style='{transform: translateX}'
    >
      <div class="tab-bar_track" ref="track">
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
      this.disableClicks = false;
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
      this.disableClicks = true;
    },

    /**
     * Touchend/touchcancel/mouseup event handler.
     */
    onTouchEnd(evt) {
      this.isTouching = false;
      this.removeEventListeners();

      setTimeout(() => {
        this.disableClicks = false;
      }, 0);
    },

    /**
     * Click handler. Blocks href follow if the user is dragging the slider.
     * https://github.com/nolimits4web/Swiper/issues/25
     */
    onClick(evt) {
      if (this.disableClicks) {
        evt.preventDefault();
      }
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
