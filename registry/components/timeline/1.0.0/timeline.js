export default (options = {}) => ({
    shown: [],
    items: options.items || [],

    init() {
        setTimeout(() => {
            this.shown = this.items.map((_, index) => index);
        }, 100);
    },
});
