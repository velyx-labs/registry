<div x-show="subOpen" x-cloak x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95" {{ $attributes->merge(['class' => 'bg-popover text-popover-foreground absolute top-0 left-full z-50 ml-1 min-w-40 rounded-md border border-border p-1 shadow-md']) }}
    data-slot="dropdown-menu-sub-content">
    {{ $slot }}
</div>