export default (options = {}) => ({
  open: false,
  selected: options.selected || null,
  value: options.value || "",
  search: "",
  focusedIndex: -1,
  options: options.options || [],
  name: options.name || null,

  get filteredOptions() {
    if (!this.search) return this.options;
    return this.options.filter((option) =>
      option.label.toLowerCase().includes(this.search.toLowerCase()),
    );
  },

  selectOption(option, index) {
    this.selected = option;
    this.value = option.value;
    this.focusedIndex = index;
    this.open = false;
    this.search = "";

    if (this.name && window.Livewire) {
      window.Livewire.find(
        this.$el.closest("[wire\\:id]").getAttribute("wire:id"),
      ).set(this.name, option.value);
    }
  },

  handleKeydown(event) {
    const options = this.filteredOptions;

    if (event.key === "ArrowDown") {
      event.preventDefault();
      this.focusedIndex = Math.min(this.focusedIndex + 1, options.length - 1);
      this.$nextTick(() => {
        const element = this.$refs.listbox?.children[this.focusedIndex];
        element?.scrollIntoView({ block: "nearest" });
      });
    } else if (event.key === "ArrowUp") {
      event.preventDefault();
      this.focusedIndex = Math.max(this.focusedIndex - 1, 0);
      this.$nextTick(() => {
        const element = this.$refs.listbox?.children[this.focusedIndex];
        element?.scrollIntoView({ block: "nearest" });
      });
    } else if (event.key === "Enter") {
      event.preventDefault();
      if (this.focusedIndex >= 0 && options[this.focusedIndex]) {
        this.selectOption(options[this.focusedIndex], this.focusedIndex);
      }
    } else if (event.key === "Escape") {
      this.open = false;
    }
  },
});
