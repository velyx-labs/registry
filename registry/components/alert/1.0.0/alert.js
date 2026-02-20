export default (options = {}) => ({
  open: true,
  dismissible: options.dismissible || false,

  close() {
    if (this.dismissible) {
      this.open = false;
    }
  },
});
