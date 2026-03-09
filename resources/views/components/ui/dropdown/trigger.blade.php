@props([
    'asChild' => false,
])

@if($asChild)
    <div {{ $attributes->merge(['data-slot' => 'dropdown-menu-trigger']) }} @click="toggleMenu()">
        {{ $slot }}
    </div>
@else
    <button
        type="button"
        {{ $attributes->merge(['class' => 'inline-flex h-9 items-center justify-center rounded-md border border-input bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground', 'data-slot' => 'dropdown-menu-trigger']) }}
        @click="toggleMenu()"
        :aria-expanded="open"
        aria-haspopup="menu"
    >
        {{ $slot }}
    </button>
@endif
