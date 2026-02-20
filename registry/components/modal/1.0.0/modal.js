export default (options = {}) => ({
  open: false,
  closeable: options.closeable !== false,

  init() {
    // Listen for open/close events
    this.$el.addEventListener(`open-modal-${options.id}`, () => {
      this.open = true;
    });

    this.$el.addEventListener(`close-modal-${options.id}`, () => {
      this.open = false;
    });
  },

  close() {
    if (this.closeable) {
      this.open = false;
    }
  },

  handleKeydown(event) {
    if (event.key === "Escape" && this.closeable) {
      this.close();
    }
  },
});
