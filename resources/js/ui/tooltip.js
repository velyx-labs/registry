export default (options = {}) => ({
  show: false,
  timeout: null,
  delay: options.delay || 200,

  showTooltip() {
    this.timeout = setTimeout(() => {
      this.show = true;
    }, this.delay);
  },

  hideTooltip() {
    clearTimeout(this.timeout);
    this.show = false;
  },
});
