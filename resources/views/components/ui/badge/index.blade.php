@props([
    'variant' => 'default',
    'size' => 'md',
    'pill' => false,
    'icon' => null,
    'removable' => false,
])

@php
    $variantClasses = match($variant) {
        'primary' => 'bg-primary/10 dark:bg-primary/20 text-primary border-primary/20 dark:border-primary/30',
        'secondary' => 'bg-secondary text-secondary-foreground border-border',
        'destructive' => 'bg-destructive/10 border-destructive/20 text-destructive',
        'outline' => 'bg-transparent border-border text-foreground',
        default => 'bg-muted text-muted-foreground border-border',
    };

    $sizeClasses = match($size) {
        'sm' => 'text-xs px-2 py-0.5',
        'lg' => 'text-sm px-3 py-1.5',
        default => 'text-xs px-2.5 py-1', // md
    };

    $iconSize = match($size) {
        'sm' => 'h-3 w-3',
        'lg' => 'h-4 w-4',
        default => 'h-3.5 w-3.5',
    };
@endphp

<span
    @class([
        'inline-flex items-center gap-1.5 font-medium border transition-colors',
        $variantClasses,
        $sizeClasses,
        'rounded-full' => $pill,
        'rounded-md' => !$pill,
        $attributes->get('class'),
    ])
    {{ $attributes->except('class') }}
>
    @if($icon)
        <x-dynamic-component
            :component="'lucide-' . $icon"
            @class(['shrink-0', $iconSize])
        />
    @endif

    {{ $slot }}

    @if($removable)
        <button
            type="button"
            @click="$el.closest('span').remove()"
            class="shrink-0 hover:opacity-70 transition-opacity"
            aria-label="Remove"
        >
            <x-dynamic-component
                component="lucide-x"
                @class([$iconSize])
            />
        </button>
    @endif
</span>
