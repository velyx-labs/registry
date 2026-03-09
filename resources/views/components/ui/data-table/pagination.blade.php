<div class="mt-4 flex flex-col items-center justify-between gap-4 sm:flex-row" x-show="filteredData.length > 0" data-test="data-table-pagination">
    <div class="text-muted-foreground text-sm" data-test="data-table-info">
        Showing <span class="text-foreground font-medium" x-text="showingFrom"></span> to
        <span class="text-foreground font-medium" x-text="showingTo"></span> of
        <span class="text-foreground font-medium" x-text="filteredData.length"></span> results
    </div>

    <div class="flex items-center gap-1" data-test="data-table-page-controls">
        <button
            type="button"
            @click="previousPage()"
            :disabled="currentPage <= 1"
            class="border-border bg-background text-foreground hover:bg-accent hover:text-accent-foreground inline-flex items-center gap-1 rounded-lg border px-3 py-2 text-sm font-medium transition-colors disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-background"
        >
            <x-lucide-chevron-left class="size-4" />
            <span class="hidden sm:inline">Previous</span>
        </button>

        <div class="hidden items-center gap-1 sm:flex">
            <template x-for="page in pageNumbers" :key="page">
                <template x-if="page === '...'">
                    <span class="text-muted-foreground px-2 py-1 text-sm">...</span>
                </template>
                <template x-if="page !== '...'">
                    <button
                        type="button"
                        @click="goToPage(page)"
                        class="min-w-[36px] rounded-lg border px-2 py-1.5 text-sm font-medium transition-colors"
                        :class="currentPage === page
                            ? 'bg-primary text-primary-foreground border-primary'
                            : 'bg-background text-foreground border-border hover:bg-accent hover:text-accent-foreground'"
                        x-text="page"
                    ></button>
                </template>
            </template>
        </div>

        <span class="text-muted-foreground px-3 py-2 text-sm sm:hidden">
            Page <span x-text="currentPage" class="text-foreground font-medium"></span> of <span x-text="totalPages" class="text-foreground font-medium"></span>
        </span>

        <button
            type="button"
            @click="nextPage()"
            :disabled="currentPage >= totalPages"
            class="border-border bg-background text-foreground hover:bg-accent hover:text-accent-foreground inline-flex items-center gap-1 rounded-lg border px-3 py-2 text-sm font-medium transition-colors disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-background"
        >
            <span class="hidden sm:inline">Next</span>
            <x-lucide-chevron-right class="size-4" />
        </button>
    </div>
</div>
