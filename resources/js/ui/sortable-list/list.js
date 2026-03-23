import Sortable from "sortablejs";

export default (options = {}) => ({
    items: options.items || [],
    itemKey: options.itemKey || "id",
    handle: options.handle ?? true,
    disabled: options.disabled ?? false,
    sortable: null,

    getIndex(value) {
        const idx = this.items.findIndex(
            (i) => String(i[this.itemKey]) === String(value),
        );
        return idx; // 0-based, le +1 est dans le template
    },

    init() {
        this.$nextTick(() => {
            const list = this.$refs.sortableList;
            if (!list) return;

            this.sortable = new Sortable(list, {
                animation: options.animation ?? 150,
                ghostClass: options.ghostClass ?? "opacity-50",
                dragClass: options.dragClass ?? "shadow-lg",
                handle: options.handle ? ".sortable-handle" : undefined,
                group: options.group ?? undefined,
                disabled: this.disabled,
                onEnd: () => {
                    const orderedIds = Array.from(
                        list.querySelectorAll("[data-id]"),
                    ).map((el) => el.dataset.id);

                    // Resync items pour que getIndex reste correct après drag
                    this.items = orderedIds
                        .map((id) =>
                            this.items.find(
                                (i) => String(i[this.itemKey]) === String(id),
                            ),
                        )
                        .filter(Boolean);

                    if (options.wireModel && this.$wire) {
                        this.$wire.set(options.wireModel, orderedIds);
                    }
                },
            });
        });
    },

    destroy() {
        this.sortable?.destroy();
    },
});
