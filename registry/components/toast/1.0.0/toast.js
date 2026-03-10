export default (options = {}) => ({
  toasts: [],
  counter: 0,
  duration: options.duration || 4000,
  maxToasts: options.maxToasts || 5,

  add(toast) {
    const id = ++this.counter;
    const newToast = {
      id,
      type: toast?.type || 'info',
      title: toast?.title || '',
      message: toast?.message || '',
      duration: toast?.duration ?? this.duration,
      timeout: null,
    };

    if (newToast.duration > 0) {
      newToast.timeout = setTimeout(() => this.remove(id), newToast.duration);
    }

    this.toasts.push(newToast);

    if (this.toasts.length > this.maxToasts) {
      const oldest = this.toasts.shift();
      if (oldest?.timeout) {
        clearTimeout(oldest.timeout);
      }
    }
  },

  remove(id) {
    const index = this.toasts.findIndex((toast) => toast.id === id);
    if (index > -1) {
      const toast = this.toasts[index];
      if (toast.timeout) {
        clearTimeout(toast.timeout);
      }
      this.toasts.splice(index, 1);
    }
  },

  getClasses(type) {
    const classes = {
      success: 'bg-green-500/10 border-green-500/50 text-green-600 dark:text-green-400',
      error: 'bg-destructive/10 border-destructive/50 text-destructive',
      warning: 'bg-yellow-500/10 border-yellow-500/50 text-yellow-600 dark:text-yellow-400',
      info: 'bg-primary/10 border-primary/50 text-primary',
    };

    return classes[type] || classes.info;
  },

  getIconClasses(type) {
    const classes = {
      success: 'text-green-500',
      error: 'text-destructive',
      warning: 'text-yellow-500',
      info: 'text-primary',
    };

    return classes[type] || classes.info;
  },
});
