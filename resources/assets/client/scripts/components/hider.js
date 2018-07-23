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
  },
};
