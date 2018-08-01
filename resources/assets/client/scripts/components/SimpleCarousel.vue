<template>
  <div>
    <div class="simple-carousel"
      ref="host"
      v-on:touchstart='onTouchStart'
      v-on:mousedown='onTouchStart'
      v-on:click='onClick'
      v-on:transitionend='onTransitionEnd'
      v-bind:style='{transform: translateX, transition}'
    >
      <slot></slot>
    </div>
    <div v-if='dots' class="dots">
      <button v-for='index in buttons'
        v-bind:key='index'
        v-bind:class='dotsClass(index)'
        v-on:click='onDotClick(index)'
      ></button>
    </div>
    <div v-if='controls' class="controls">
      <button class="control control--prev"
        aria-label="previous slide"
        v-on:click='goTo(slide - 1)'
      ></button>
      <button class="control control--next"
        aria-label="next slide"
        v-on:click='goTo(slide + 1)'
      ></button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    index: {
      type: Number,
      default: 0,
    },
    controls: {
      type: Boolean,
      default: false,
    },
    dots: {
      type: Boolean,
      default: false,
    },
    /**
     * NOTE: `loop` should be passed only to sliders with one slide per view.
     */
    loop: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      x: 0,
      animate: false,
      length: this.loop ? 3 : 1,
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
      const length = this.loop ? this.length - 2 : this.length;
      return length / this.perView;
    },
  },

  mounted() {
    const host = this.$refs.host;
    const hasChildren = host.children.length < 1;
    // if no child was passed, just ignore.
    if (hasChildren) {
      return;
    }
  
    if (this.loop) {
      const first = host.firstElementChild.cloneNode(true);
      const last = host.lastElementChild.cloneNode(true);
      host.append(first);
      host.prepend(last);
    }

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
      this.disableClicks = false;
      this.delta = 0;

      // reset states
      this.goTo(this.loop ? this.index + 1 : this.index);
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
      this.disableClicks = true;
    },

    /**
     * Touchend/touchcancel/mouseup event handler.
     */
    onTouchEnd(evt) {
      this.isTouching = false;
      this.animate = true;
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
     * Transitionend event handler.
     */
    onTransitionEnd(evt) {
      this.animate = false;

      if (this.loop) {
        if (this.slide < 1) {
          this.setActive(this.length - 2);
        } else if (this.slide > this.length - 2) {
          this.setActive(1);
        }
      }
    },

    /**
     * Dot click handler.
     * Sets the slide with the given index as active.
     *
     * @param {number} index
     */
    onDotClick(index) {
      const n = this.loop ? 0 : 1;
      this.goTo(index - n);
    },

    /**
     * Generates the css class for the given dot index.
     * 
     * @param {number} index
     * @return {string} dot class
     */
    dotsClass(index) {
      const n = this.loop ? 0 : 1;
      return (this.slide === (index - n))
        ? 'dot active'
        : 'dot';
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

      this.goTo(nextSlide);
    },

    /**
     * Slides to the given slide.
     * 
     * @param {number} index
     */
    goTo(index) {
      const min = 0;
      const max = this.length - this.perView;
      const slide = Math.max(min, Math.min(index, max));
      this.setActive(slide, true);
    },

    /**
     * Sets the passed number as the active slide.
     *
     * @param {number} slide
     * @param {Boolean} animate
     */
    setActive(slide, animate) {
      this.x = -(slide * this.childWidth);
      this.slide = slide;

      if (animate) {
        this.animate = true;
      }
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
