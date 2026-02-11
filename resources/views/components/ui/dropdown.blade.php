@props([
    'placement' => 'bottom-end',
    'trigger' => 'click',
])

@php
    $placementClasses = [
        'bottom-start' => 'left-0 origin-top-left',
        'bottom-end' => 'right-0 origin-top-right',
        'bottom-center' => 'left-1/2 transform -translate-x-1/2 origin-top',
        'top-start' => 'left-0 origin-bottom-left',
        'top-end' => 'right-0 origin-bottom-right',
        'top-center' => 'left-1/2 transform -translate-x-1/2 origin-bottom',
    ];
@endphp

<div x-data="{ open: false }" class="relative inline-block text-left">
    <!-- Trigger -->
    <div @click="{{ $trigger === 'click' ? 'open = !open' : '' }}" 
         @mouseenter="{{ $trigger === 'hover' ? 'open = true' : '' }}"
         @mouseleave="{{ $trigger === 'hover' ? 'open = false' : '' }}">
        {{ $slot }}
    </div>

    <!-- Dropdown menu -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        @click.away="open = false"
        class="absolute {{ $placementClasses[$placement] ?? 'bottom-end' }} z-50 mt-2 w-56 rounded-md bg-popover border border-border shadow-lg focus:outline-none"
        x-cloak
    >
        <div class="py-1">
            {{ $dropdownMenu }}
        </div>
    </div>
</div>