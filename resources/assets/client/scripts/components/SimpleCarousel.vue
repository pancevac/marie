<template>
  <div>
    <div class="host"
      ref="host"
      v-on:touchstart='onTouchStart'
      v-on:mousedown='onTouchStart'
      v-on:click='onClick'
      v-bind:style='{transform: translateX, transition}'
    >
      <slot></slot>
    </div>
    <div v-if='dots' class="dots">
      <button v-for='index in buttons'
        v-bind:key='index'
        v-bind:class='{active: (slide === index - 1), dot: true}'
        v-on:click='setActive(index - 1)'
      ></button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    dots: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      x: 0,
      animate: true,
      length: 1,
      perView: 1,
      slide: 0,
    };
  },

  computed: {
    translateX() {
      return `translateX(${this.x}px)`;
    },

    transition() {
      return this.animate
        ? 'transform 225ms cubic-bezier(0.0, 0.0, 0.2, 1)'
        : '';
    },

    buttons() {
      return this.length / this.perView;
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
      const host = this.$refs.host;
      const gBCR = host.getBoundingClientRect();
      this.length = host.children.length;
      this.childWidth = host.firstElementChild.getBoundingClientRect().width;
      this.perView = Math.round(gBCR.width / this.childWidth);

      this.isTouching = false;
      this.disabelClicks = false;
      this.delta = 0;

      // reset state
      this.x = 0;
    },

    /**
     * Touchstart/mousedown event handler.
     */
    onTouchStart(evt) {
      evt.preventDefault();
      this.isTouching = true;
      this.animate = false;
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
      this.disabelClicks = true;
    },

    /**
     * Touchend/touchcancel/mouseup event handler.
     */
    onTouchEnd(evt) {
      this.isTouching = false;
      this.animate = true;
      this.removeEventListeners();

      setTimeout(() => {
        this.disabelClicks = false;
      }, 0);
    },

    /**
     * Click handler. Blocks href follow if the user is dragging the slider.
     * https://github.com/nolimits4web/Swiper/issues/25
     */
    onClick(evt) {
      if (this.disabelClicks) {
        evt.preventDefault();
      }
    },

    /**
     * Responds to user gestures and updates the state accordingly.
     */
    update() {
      this.x = this.delta - (this.slide * this.childWidth);
      
      if (this.isTouching) {
        window.requestAnimationFrame(this.update);
        return;
      }

      let currentSlide = this.slide;
      let nextSlide = currentSlide;
      const clearance = .25 * this.childWidth;
      const slidesMoved = Math.floor(Math.abs(this.delta / this.childWidth));

      if (this.delta < -clearance) {
        nextSlide = currentSlide + (1 + slidesMoved);
      } else if (this.delta > clearance) {
        nextSlide = currentSlide - (1 + slidesMoved);
      }

      const min = 0;
      const max = this.length - this.perView;
      // Make sure value is in range.
      const slide = Math.max(min, Math.min(nextSlide, max));
      this.setActive(slide);
    },

    /**
     * Sets the passed number as the active slide.
     *
     * @param {number} slide
     */
    setActive(slide) {
      this.x = -(slide * this.childWidth);
      this.slide = slide;
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
    will-change: transform;
    transform: translateX(0);
    font-size: 0;
  }

  .host > .slider-item {
    display: inline-block;
    overflow: hidden;
    font-size: initial;
    white-space: initial;
  }
</style>
