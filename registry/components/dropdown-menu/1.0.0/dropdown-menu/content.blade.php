@props([
    'align' => 'center',
])

@php
    $alignClasses = match($align) {
        'start' => 'left-0',
        'end' => 'right-0',
        default => 'left-1/2 -translate-x-1/2',
    };
@endphp

<div
    x-show="open"
    x-cloak
    @click.away="closeMenu()"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    {{ $attributes->merge(['class' => "bg-popover text-popover-foreground absolute top-full z-50 mt-2 min-w-40 rounded-md border border-border p-1 shadow-md {$alignClasses}"]) }}
    role="menu"
    data-slot="dropdown-menu-content"
>
    {{ $slot }}
</div>
