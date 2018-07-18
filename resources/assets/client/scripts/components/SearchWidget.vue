<template>
  <form id="search-form"
    v-bind:class='{"search-open": show}'
    v-on:submit='onSubmit'
  >
    <div class="search-widget">
      <button class="icon-btn search-widget_search" type="submit">
        <svg class="icon" role="presentation">
          <use xlink:href="#icon_search"></use>
        </svg>
      </button>
      <input type="text"
        ref='input'
        placeholder="Pretraži"
        v-bind:value='value'
      >
      <div class="search-widget_border"></div>
      <button class="icon-btn search-widget_close"
        type="reset"
        v-on:click='hide'
      >
        <svg class="icon" role="presentation">
          <use xlink:href="#icon_close"></use>
        </svg>
      </button>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      value: '',
      show: false,
    };
  },

  mounted() {
    window.addEventListener('keydown', this.onKeyDown);
  },

  destroyed() {
    window.removeEventListener('keydown', this.onKeyDown);
  },

  methods: {
    onSubmit(evt) {
      if (this.value === '') {
        evt.preventDefault();
        this.$refs.input.focus();
        this.show = true;
      }
    },

    onKeyDown(evt) {
      if (!this.show) {
        return;
      }

      if (evt.keyCode === 27) {
        this.hide();
      }
    },

    hide() {
      this.show = false;
    },
  },
}
</script>
