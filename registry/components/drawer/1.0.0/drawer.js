export default (options = {}) => ({
  open: false,

  toggle() {
    this.open = !this.open;
  },

  close() {
    this.open = false;
  },

  handleOpenEvent(event) {
    if (!event.detail?.id || event.detail?.id === this.$el.id) {
      this.open = true;
    }
  },

  handleCloseEvent(event) {
    if (!event.detail?.id || event.detail?.id === this.$el.id) {
      this.open = false;
    }
  },

  handleToggleEvent(event) {
    if (!event.detail?.id || event.detail?.id === this.$el.id) {
      this.toggle();
    }
  },
});
