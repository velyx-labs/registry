import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);

export default (options = {}) => ({
    type: options.type === "multiple" ? "multiple" : "single",
    collapsible: options.collapsible !== false,
    openItems: (() => {
        const value = options.defaultValue ?? null;

        if (Array.isArray(value)) {
            return value.map(String);
        }

        if (value === null || value === undefined || value === "") {
            return [];
        }

        return [String(value)];
    })(),

    toggle(value) {
        const itemValue = String(value);

        if (this.type === "multiple") {
            const idx = this.openItems.indexOf(itemValue);

            if (idx > -1) {
                this.openItems.splice(idx, 1);

                return;
            }

            this.openItems.push(itemValue);

            return;
        }

        const isCurrentlyOpen = this.isOpen(itemValue);

        if (isCurrentlyOpen && this.collapsible) {
            this.openItems = [];

            return;
        }

        this.openItems = isCurrentlyOpen ? this.openItems : [itemValue];
    },

    isOpen(value) {
        return this.openItems.includes(String(value));
    },
});
