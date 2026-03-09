@props([
    'searchable' => true,
    'filterable' => true,
    'searchPlaceholder' => 'Search...',
])

<div class="mb-4 flex flex-col gap-4 sm:flex-row" data-test="data-table-toolbar">
    @if($searchable)
        <div class="relative max-w-sm flex-1">
            <x-lucide-search class="text-muted-foreground absolute top-1/2 left-3 size-4 -translate-y-1/2" />
            <input
                type="text"
                x-model.debounce.300ms="search"
                placeholder="{{ $searchPlaceholder }}"
                class="bg-background border-input focus:ring-ring w-full rounded-lg border py-2.5 pr-4 pl-10 text-sm transition-colors focus:ring-2 focus:outline-none"
                data-test="data-table-search"
            />
        </div>
    @endif

    @if($filterable)
        <div class="flex flex-wrap gap-2" data-test="data-table-filters">
            <template x-for="col in columns.filter(c => c.filterable)" :key="col.key">
                <div class="relative">
                    <select
                        x-model="filters[col.key]"
                        @change="setFilter(col.key, $event.target.value)"
                        class="bg-background border-input focus:ring-ring cursor-pointer appearance-none rounded-lg border py-2 pr-8 pl-3 text-sm focus:ring-2 focus:outline-none"
                    >
                        <option value="all" x-text="`All ${col.label}`"></option>
                        <template x-for="val in getUniqueValues(col.key)" :key="val">
                            <option :value="val" x-text="val"></option>
                        </template>
                    </select>
                    <x-lucide-chevron-down class="text-muted-foreground pointer-events-none absolute top-1/2 right-2 size-4 -translate-y-1/2" />
                </div>
            </template>

            <button
                type="button"
                @click="resetFilters()"
                x-show="search || Object.values(filters).some(v => v && v !== 'all') || sortColumn"
                x-transition
                class="text-muted-foreground hover:text-foreground bg-muted/50 hover:bg-muted inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm transition-colors"
                data-test="data-table-reset"
            >
                <x-lucide-x class="size-3.5" />
                Reset
            </button>
        </div>
    @endif
</div>
