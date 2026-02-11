export default (options = {}) => ({
  open: false,
  trigger: options.trigger || "click",

  toggle() {
    this.open = !this.open;
  },

  close() {
    this.open = false;
  },

  handleHover() {
    if (this.trigger === "hover") {
      this.open = true;
    }
  },

  handleLeave() {
    if (this.trigger === "hover") {
      this.open = false;
    }
  },

  handleEscape() {
    this.close();
  },
});
