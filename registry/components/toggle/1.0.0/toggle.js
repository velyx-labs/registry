export default (options = {}) => ({
  checked: options.checked || false,
  disabled: options.disabled || false,
  name: options.name || null,

  toggle() {
    if (this.disabled) return;

    this.checked = !this.checked;

    // Update Livewire if name is provided
    if (this.name && window.Livewire) {
      const livewireComponent = window.Livewire.find(
        this.$el.closest("[wire\\:id]")?.getAttribute("wire:id"),
      );
      if (livewireComponent) {
        livewireComponent.set(this.name, this.checked);
      }
    }
  },
});
