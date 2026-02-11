@props([
    'variant' => 'default',
    'size' => 'default',
    'type' => 'button',
    'href' => null,
    'icon' => null,
    'iconPosition' => 'left'
])

@php
    $variantClasses = [
        'default' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'destructive' => 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
        'outline' => 'border border-input bg-background hover:bg-accent hover:text-accent-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
        'link' => 'text-primary underline-offset-4 hover:underline',
    ];

    $sizeClasses = [
        'default' => 'h-10 px-4 py-2',
        'sm' => 'h-9 rounded-md px-3',
        'lg' => 'h-11 rounded-md px-8',
        'icon' => 'h-10 w-10',
    ];

    $baseClasses = 'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? '') . ' ' . ($sizeClasses[$size] ?? '');
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $classes }}">
        @if ($icon && $iconPosition === 'left')
            <x-lucide-{{ $icon }} class="w-4 h-4 mr-2" />
        @endif
        
        {{ $slot }}
        
        @if ($icon && $iconPosition === 'right')
            <x-lucide-{{ $icon }} class="w-4 h-4 ml-2" />
        @endif
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes }}">
        @if ($icon && $iconPosition === 'left')
            <x-lucide-{{ $icon }} class="w-4 h-4 mr-2" />
        @endif
        
        {{ $slot }}
        
        @if ($icon && $iconPosition === 'right')
            <x-lucide-{{ $icon }} class="w-4 h-4 ml-2" />
        @endif
    </button>
@endif