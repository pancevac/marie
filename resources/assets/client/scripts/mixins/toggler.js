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

    toggle() {
      this.open = !this.open;
    },

    /**
     * keyup event handler.
     * Hides the element on `Esc` key press.
     *
     * @param {Event} evt keyup event object.
     */
    onKeyUp(evt) {
      if (evt.keyCode === 27 && this.open) {
        this.hide();
      }
    },
  },
};
