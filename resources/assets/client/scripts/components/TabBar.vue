<template>
  <div class="host"
    v-on:touchstart='onTouchStart'
    v-on:mousedown='onTouchStart'
    v-bind:style='{transform: translateX}'
  >
    <div class="track" ref="track">
      <slot></slot>
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

  created() {
    this.isTouching = false;
    this.delta = 0;
    this.currentX = 0;
    this.max = 0;
    this.min = 0;
  },

  mounted() {
    const width = this.$refs.track.getBoundingClientRect().width;
    const clientWidth = document.documentElement.clientWidth;
    if (width > clientWidth) {
      this.min = -(width - clientWidth);
    }
  },

  methods: {
    onTouchStart(evt) {
      evt.preventDefault();
      this.isTouching = true;
      this.delta = 0;
      this.startX = evt.pageX || evt.touches[0].pageX;
      this.addEventListeners();
      window.requestAnimationFrame(this.update);
    },

    onTouchMove(evt) {
      this.delta = (evt.pageX || evt.touches[0].pageX) - this.startX;
    },

    onTouchEnd(evt) {
      this.isTouching = false;
      this.removeEventListeners();
    },

    update() {
      let screenX = this.delta + this.currentX;
      const x = Math.min(Math.max(this.min, screenX), this.max);
      this.screenX = x;

      if (this.isTouching) {
        window.requestAnimationFrame(this.update);
        return;
      }

      this.currentX = x;
    },

    addEventListeners() {
      document.addEventListener('mousemove', this.onTouchMove);
      document.addEventListener('mouseup', this.onTouchEnd);
    },

    removeEventListeners() {
      document.removeEventListener('mousemove', this.onTouchMove);
      document.removeEventListener('mouseup', this.onTouchEnd);
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

  .track {
    display: inline-block;
  }

  .track > * {
    display: inline-block;
    overflow: hidden;
    font-size: initial;
  }
</style>

