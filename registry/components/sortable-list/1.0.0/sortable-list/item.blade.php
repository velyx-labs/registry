@props([
    'value' => null,
])
<li
    x-data="sortableListItem('{{ $value }}')"
    class="sortable-item group relative flex items-center gap-3 p-3 bg-card border border-border rounded-lg transition-all duration-200 hover:border-primary/50 hover:shadow-sm"
    :data-id="value"
>
    <div class="sortable-handle flex-shrink-0 cursor-grab active:cursor-grabbing p-1 rounded hover:bg-muted transition-colors">
        <svg class="size-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
        </svg>
    </div>

    <div class="flex-1 min-w-0">
        {{ $slot }}
    </div>

    <span class="flex-shrink-0 size-6 flex items-center justify-center text-xs font-medium text-muted-foreground bg-muted rounded-full"
        x-text="index + 1"
    ></span>
</li>