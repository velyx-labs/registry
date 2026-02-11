export default (options = {}) => ({
  search: "",
  sortColumn: null,
  sortDirection: "asc",
  filters: {},
  currentPage: 1,
  perPage: options.perPage || 10,
  loading: options.loading || false,
  data: options.data || [],
  columns: options.columns || [],

  get filteredData() {
    let result = [...this.data];

    // Apply search
    if (this.search) {
      const searchLower = this.search.toLowerCase();
      result = result.filter((row) => {
        return this.columns.some((col) => {
          const value = row[col.key];
          return value && String(value).toLowerCase().includes(searchLower);
        });
      });
    }

    // Apply column filters
    Object.keys(this.filters).forEach((key) => {
      const filterValue = this.filters[key];
      if (filterValue && filterValue !== "all") {
        result = result.filter(
          (row) => String(row[key]) === String(filterValue),
        );
      }
    });

    // Apply sorting
    if (this.sortColumn) {
      result.sort((a, b) => {
        const aVal = a[this.sortColumn] ?? "";
        const bVal = b[this.sortColumn] ?? "";

        if (typeof aVal === "number" && typeof bVal === "number") {
          return this.sortDirection === "asc" ? aVal - bVal : bVal - aVal;
        }

        const comparison = String(aVal).localeCompare(String(bVal));
        return this.sortDirection === "asc" ? comparison : -comparison;
      });
    }

    return result;
  },

  get paginatedData() {
    const start = (this.currentPage - 1) * this.perPage;
    return this.filteredData.slice(start, start + this.perPage);
  },

  get totalPages() {
    return Math.ceil(this.filteredData.length / this.perPage);
  },

  get pageNumbers() {
    const total = this.totalPages;
    const current = this.currentPage;
    const pages = [];

    if (total <= 7) {
      for (let i = 1; i <= total; i++) pages.push(i);
    } else if (current <= 3) {
      pages.push(1, 2, 3, 4, "...", total);
    } else if (current >= total - 2) {
      pages.push(1, "...", total - 3, total - 2, total - 1, total);
    } else {
      pages.push(1, "...", current - 1, current, current + 1, "...", total);
    }

    return pages;
  },

  get showingFrom() {
    return this.filteredData.length === 0
      ? 0
      : (this.currentPage - 1) * this.perPage + 1;
  },

  get showingTo() {
    return Math.min(this.currentPage * this.perPage, this.filteredData.length);
  },

  sort(column) {
    if (this.sortColumn === column) {
      this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
    } else {
      this.sortColumn = column;
      this.sortDirection = "asc";
    }
  },

  setFilter(column, value) {
    this.filters[column] = value;
    this.currentPage = 1;
  },

  getUniqueValues(column) {
    const values = new Set();
    this.data.forEach((row) => {
      if (row[column] !== null && row[column] !== undefined) {
        values.add(row[column]);
      }
    });
    return Array.from(values).sort();
  },

  resetFilters() {
    this.search = "";
    this.filters = {};
    this.sortColumn = null;
    this.sortDirection = "asc";
    this.currentPage = 1;
  },

  goToPage(page) {
    if (page >= 1 && page <= this.totalPages) {
      this.currentPage = page;
    }
  },

  previousPage() {
    if (this.currentPage > 1) this.currentPage--;
  },

  nextPage() {
    if (this.currentPage < this.totalPages) this.currentPage++;
  },

  init() {
    this.$watch("search", () => (this.currentPage = 1));
  },
});
