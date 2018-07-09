<template>
  <header class="header">
    <div class="container header-wrap">
      <button v-on:click='onClick'>click me</button>
      <span v-if='visible'>visible</span>
    </div>
  </header>
</template>

<script>
export default {
  created() {
    console.log('header, created.');
  },

  data() {
    return {
      visible: false,
    };
  },

  methods: {
    onClick(evt) {
      this.visible = !this.visible;
      console.log(`header state visible: ${this.visible}`);
    },
  },
};
</script>
