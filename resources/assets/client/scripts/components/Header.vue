<template>
  <header>
    <button v-on:click='onClick'>click me</button>
    <span v-if='visible'>visible</span>
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
