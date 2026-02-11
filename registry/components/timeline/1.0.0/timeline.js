export default (options = {}) => ({
  shown: [],
  items: options.items || [],

  init() {
    setTimeout(() => {
      this.shown = Object.keys(this.items);
    }, 100);
  },
});
