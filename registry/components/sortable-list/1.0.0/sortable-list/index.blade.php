@props([
    'items' => [],
    'itemKey' => 'id',
    'handle' => true,
    'animation' => 150,
    'ghostClass' => 'opacity-50',
    'dragClass' => 'shadow-lg',
    'disabled' => false,
    'group' => null,
])
<div
    x-data="sortableList({
        items: {{ json_encode($items) }},
        itemKey: '{{ $itemKey }}',
        handle: {{ json_encode($handle) }},
        animation: {{ $animation }},
        ghostClass: '{{ $ghostClass }}',
        dragClass: '{{ $dragClass }}',
        disabled: {{ json_encode($disabled) }},
        group: {{ $group ? "'$group'" : 'null' }},
        wireModel: '{{ $attributes->wire('model')->value() }}'
    })"
    {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'sortable-list']) }}
>
    <ul
        x-ref="sortableList"
        role="list"
        x-show="items.length > 0"
        @class(['space-y-2', 'opacity-60 pointer-events-none' => $disabled])
    >
        {{ $slot }}
    </ul>
    <div
        x-show="items.length === 0"
        x-cloak
        class="flex flex-col items-center justify-center py-12 text-center border-2 border-dashed border-border rounded-lg"
    >
        <x-lucide-inbox class="size-12 text-muted-foreground/50 mb-3" />
        <p class="text-sm text-muted-foreground">No items in the list</p>
    </div>
</div>
