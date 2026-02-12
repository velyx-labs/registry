export default (options = {}) => ({
  activeTab: options.default || "",

  init() {
    if (!this.activeTab) {
      const firstTab = this.$el.querySelector("[role=tab]");
      this.activeTab = firstTab?.dataset?.tab || "";
    }
  },

  setActiveTab(tabId) {
    this.activeTab = tabId;
  },
});
