@props([
    'sortable' => true,
    'loading' => false,
    'emptyMessage' => 'No data available',
])

<div class="border-border overflow-x-auto rounded-xl border" data-test="data-table-wrapper">
    <table class="caption-bottom w-full table-auto text-sm" data-test="data-table">
        <thead class="bg-muted/50 [&_tr]:border-b">
            <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                <template x-for="col in columns" :key="col.key">
                    <th
                        class="text-foreground w-[100px] px-4 py-3 text-left text-sm font-semibold"
                        :class="{ 'hover:bg-muted/80 cursor-pointer select-none transition-colors': col.sortable !== false && {{ $sortable ? 'true' : 'false' }} }"
                        @click="col.sortable !== false && {{ $sortable ? 'true' : 'false' }} ? sort(col.key) : null"
                    >
                        <div class="flex items-center gap-2">
                            <span x-text="col.label"></span>
                            <template x-if="col.sortable !== false && {{ $sortable ? 'true' : 'false' }}">
                                <div class="flex flex-col">
                                    <x-lucide-chevron-up
                                        class="-mb-1 size-3"
                                        ::class="sortColumn === col.key && sortDirection === 'asc' ? 'text-primary' : 'text-muted-foreground/40'"
                                    />
                                    <x-lucide-chevron-down
                                        class="size-3"
                                        ::class="sortColumn === col.key && sortDirection === 'desc' ? 'text-primary' : 'text-muted-foreground/40'"
                                    />
                                </div>
                            </template>
                        </div>
                    </th>
                </template>
            </tr>
        </thead>

        <tbody class="divide-border divide-y">
            <template x-if="loading">
                @for($i = 0; $i < 5; $i++)
                    <tr>
                        <template x-for="col in columns" :key="col.key + '-skeleton-{{ $i }}'">
                            <td class="px-4 py-3">
                                <div class="bg-muted h-4 animate-pulse rounded"></div>
                            </td>
                        </template>
                    </tr>
                @endfor
            </template>

            <template x-if="!loading">
                <template x-for="(row, index) in paginatedData" :key="index">
                    <tr class="hover:bg-muted/30 transition-colors" data-test="data-table-row">
                        <template x-for="col in columns" :key="col.key">
                            <td class="text-foreground px-4 py-3 text-sm" x-html="row[col.key] ?? '-'"></td>
                        </template>
                    </tr>
                </template>
            </template>

            <template x-if="!loading && paginatedData.length === 0">
                <tr>
                    <td :colspan="columns.length" class="px-4 py-12 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <x-lucide-inbox class="text-muted-foreground/50 size-12" />
                            <p class="text-muted-foreground">{{ $emptyMessage }}</p>
                            <button
                                type="button"
                                @click="resetFilters()"
                                x-show="search || Object.values(filters).some(v => v && v !== 'all')"
                                class="text-primary text-sm hover:underline"
                            >
                                Clear filters
                            </button>
                        </div>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>
