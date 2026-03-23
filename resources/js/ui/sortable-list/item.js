export default (value) => ({
    value: String(value),
    item: null,
    index: 0,

    init() {
        // Remonte jusqu'au parent sortableList
        const findParent = (el) => {
            if (!el) return null;
            if (el._x_dataStack) {
                const data = el._x_dataStack.find((d) =>
                    Array.isArray(d.items),
                );
                if (data) return data;
            }
            return findParent(el.parentElement);
        };

        const parent = findParent(this.$el.parentElement);

        if (parent) {
            const sync = () => {
                this.item =
                    parent.items.find(
                        (i) => String(i[parent.itemKey]) === this.value,
                    ) || null;
                this.index = parent.items.findIndex(
                    (i) => String(i[parent.itemKey]) === this.value,
                );
            };
            sync();
            this.$watch(
                () => parent.items.map((i) => i[parent.itemKey]).join(","),
                sync,
            );
        }
    },
});
