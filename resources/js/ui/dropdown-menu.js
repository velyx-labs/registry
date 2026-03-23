export default (options = {}) => ({
    open: options.open ?? false,

    toggleMenu() {
        this.open = !this.open;
    },

    openMenu() {
        this.open = true;
    },

    closeMenu() {
        this.open = false;
    },
});
