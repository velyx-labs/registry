@props([
    'max' => 5,
    'readonly' => false,
    'size' => 'md',
    'showValue' => false,
    'allowHalf' => false,
    'variant' => 'default',
])

@php
    $starSize = match($size) {
        'sm' => 'size-4',
        'lg' => 'size-8',
        default => 'size-6',
    };

    $textSize = match($size) {
        'sm' => 'text-xs',
        'lg' => 'text-base',
        default => 'text-sm',
    };

    $colors = match($variant) {
        'primary' => ['empty' => 'text-muted', 'filled' => 'text-primary', 'hover' => 'group-hover:text-primary/70'],
        'secondary' => ['empty' => 'text-muted', 'filled' => 'text-secondary-foreground', 'hover' => 'group-hover:text-secondary-foreground/80'],
        'destructive', 'red' => ['empty' => 'text-muted', 'filled' => 'text-destructive', 'hover' => 'group-hover:text-destructive/80'],
        'outline' => ['empty' => 'text-border', 'filled' => 'text-foreground', 'hover' => 'group-hover:text-foreground/80'],
        'ghost' => ['empty' => 'text-muted', 'filled' => 'text-muted-foreground', 'hover' => 'group-hover:text-foreground/80'],
        'default' => ['empty' => 'text-muted', 'filled' => 'text-primary', 'hover' => 'group-hover:text-primary/70'],
        default => ['empty' => 'text-muted', 'filled' => 'text-primary', 'hover' => 'group-hover:text-primary/70'],
    };

    $wireModel = $attributes->wire('model')->value();
@endphp

<div
    x-data="rating(@if($wireModel) @entangle($attributes->wire('model')).live @else 0 @endif, {
        max: {{ $max }},
        readonly: {{ $readonly ? 'true' : 'false' }},
        allowHalf: {{ $allowHalf ? 'true' : 'false' }}
    })"
    class="inline-flex items-center gap-2"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <div class="flex items-center gap-0.5">
        <template x-for="star in {{ $max }}" :key="star">
            <button
                type="button"
                @click="!readonly && setRating(star)"
                @mouseenter="!readonly && (hoverValue = star)"
                @mouseleave="!readonly && (hoverValue = 0)"
                :disabled="readonly"
                class="group relative focus:outline-none transition-transform hover:scale-110 disabled:cursor-default disabled:hover:scale-100"
            >
                <x-lucide-star
                    class="{{ $starSize }} {{ $colors['empty'] }} transition-colors {{ $readonly ? '' : $colors['hover'] }}"
                />

                <div
                    class="absolute inset-0 overflow-hidden transition-all"
                    :style="`width: ${getStarFillWidth(star)}%`"
                >
                    <x-lucide-star
                        class="{{ $starSize }} {{ $colors['filled'] }} transition-colors"
                        fill="currentColor"
                    />
                </div>
            </button>
        </template>
    </div>

    @if($showValue)
        <span class="font-medium text-muted-foreground {{ $textSize }}" x-text="value.toFixed(1)"></span>
    @endif
</div>
