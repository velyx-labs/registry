@props([
    'columns' => [],
    'data' => [],
    'searchable' => true,
    'filterable' => true,
    'sortable' => true,
    'paginated' => true,
    'perPage' => 10,
    'loading' => false,
    'emptyMessage' => 'No data available',
    'searchPlaceholder' => 'Search...',
])

<div
    {{ $attributes->merge(['class' => 'w-full']) }}
    x-data="dataTable({
        perPage: {{ $perPage }},
        loading: {{ $loading ? 'true' : 'false' }},
        data: {{ json_encode($data) }},
        columns: {{ json_encode($columns) }}
    })"
    data-slot="data-table"
>
    <x-ui.data-table.toolbar
        :searchable="$searchable"
        :filterable="$filterable"
        :search-placeholder="$searchPlaceholder"
    />

    <x-ui.data-table.table
        :sortable="$sortable"
        :loading="$loading"
        :empty-message="$emptyMessage"
    />

    @if($paginated)
        <x-ui.data-table.pagination />
    @endif
</div>
