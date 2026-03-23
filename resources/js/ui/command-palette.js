export default (options = {}) => ({
    open: options.open ?? false,
    selectedIndex: 0,

    init() {
        this.$watch("open", (value) => {
            if (value) {
                this.selectedIndex = 0;
            }
        });
    },

    openPalette() {
        this.open = true;
    },

    closePalette() {
        this.open = false;
    },

    navigateUp() {
        if (this.selectedIndex > 0) {
            this.selectedIndex--;
        }
    },

    navigateDown(maxItems) {
        if (this.selectedIndex < maxItems - 1) {
            this.selectedIndex++;
        }
    },
});
