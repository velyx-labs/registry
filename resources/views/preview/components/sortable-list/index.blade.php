@props([
    'props' => [],
])

@php
    $items = [
        ['id' => 1, 'title' => 'Refine hero copy', 'meta' => 'Marketing'],
        ['id' => 2, 'title' => 'Review API docs', 'meta' => 'Docs'],
        ['id' => 3, 'title' => 'Ship component previews', 'meta' => 'Product'],
    ];
    $handle = ! array_key_exists('handle', $props) || filter_var($props['handle'], FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-xl rounded-xl border border-border bg-card p-5">
        <x-ui.sortable-list :items="$items" :handle="$handle">
            <template x-if="item">
                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-foreground" x-text="item.title"></p>
                    <p class="text-xs text-muted-foreground" x-text="item.meta"></p>
                </div>
            </template>
        </x-ui.sortable-list>
    </div>
</div>
