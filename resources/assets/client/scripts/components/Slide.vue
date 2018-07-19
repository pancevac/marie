<template>
  <div v-bind:class='className'>
    <div class="slide_image">
      <img
        v-bind:src='src'
        v-bind:alt='alt'
        v-on:load.once='onLoad'
      />
    </div>
    <div class="p-3 slide_info" style="background-color: #f7f7f7;">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    src: {
      type: String,
      required: true,
    },
    alt: {
      type: String,
    },
  },

  data() {
    return {
      orientation: 'portrait',
    };
  },

  computed: {
    className() {
      return `slide slide--${this.orientation}`;
    }
  },

  methods: {
    onLoad(evt) {
      /**
       * Image onload event handler.
       * Sets the proper orientation based on the image dimensions.
       */
      const img = evt.target;
      const w = img.naturalWidth;
      const h = img.naturalHeight;
      this.orientation = w > h
        ? 'landscape'
        : 'portrait';
    }
  },
}
</script>
