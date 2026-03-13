export default (options = {}) => ({
  open: false,
  closeable: options.closeable !== false,

  close() {
    if (this.closeable) {
      this.open = false;
    }
  },

  handleKeydown(event) {
    if (event.key === 'Escape' && this.closeable) {
      this.close();
    }
  },
});
