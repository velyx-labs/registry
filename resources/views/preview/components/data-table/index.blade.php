@props([
    'props' => [],
])

@php
    $columns = [
        ['key' => 'id', 'label' => 'ID', 'sortable' => true],
        ['key' => 'name', 'label' => 'Name', 'sortable' => true],
        ['key' => 'role', 'label' => 'Role', 'sortable' => true, 'filterable' => true],
        ['key' => 'status', 'label' => 'Status', 'sortable' => true, 'filterable' => true],
    ];

    $data = [
        ['id' => 1, 'name' => 'Sofia Laurent', 'role' => 'Admin', 'status' => 'Active'],
        ['id' => 2, 'name' => 'Lucas Martin', 'role' => 'Editor', 'status' => 'Active'],
        ['id' => 3, 'name' => 'Emma Bernard', 'role' => 'Viewer', 'status' => 'Pending'],
        ['id' => 4, 'name' => 'Noah Petit', 'role' => 'Editor', 'status' => 'Inactive'],
        ['id' => 5, 'name' => 'Lina Robert', 'role' => 'Viewer', 'status' => 'Active'],
        ['id' => 6, 'name' => 'Hugo Richard', 'role' => 'Admin', 'status' => 'Pending'],
        ['id' => 7, 'name' => 'Mila Dubois', 'role' => 'Editor', 'status' => 'Active'],
        ['id' => 8, 'name' => 'Ethan Morel', 'role' => 'Viewer', 'status' => 'Inactive'],
    ];
@endphp

<div class="preview w-full p-6">
    <x-ui.data-table :columns="$columns" :data="$data" :per-page="5" />
</div>
