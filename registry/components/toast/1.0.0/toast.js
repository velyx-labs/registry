export default (options = {}) => ({
  toasts: [],
  counter: 0,
  duration: options.duration || 4000,
  maxToasts: options.maxToasts || 5,

  add(toast) {
    const id = ++this.counter;
    const newToast = {
      id,
      ...toast,
      timeout: setTimeout(() => this.remove(id), this.duration),
    };

    this.toasts.push(newToast);

    // Remove oldest toast if maxToasts exceeded
    if (this.toasts.length > this.maxToasts) {
      const oldest = this.toasts.shift();
      clearTimeout(oldest.timeout);
    }
  },

  remove(id) {
    const index = this.toasts.findIndex((toast) => toast.id === id);
    if (index > -1) {
      const toast = this.toasts[index];
      clearTimeout(toast.timeout);
      this.toasts.splice(index, 1);
    }
  },

  clear() {
    this.toasts.forEach((toast) => clearTimeout(toast.timeout));
    this.toasts = [];
  },
});
