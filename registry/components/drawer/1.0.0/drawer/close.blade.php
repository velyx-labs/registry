@props([
    'asChild' => false,
    'target' => null,
])

@if($asChild)
    <div
        {{ $attributes->merge(['data-slot' => 'drawer-close']) }}
        @click="$dispatch('drawer-close', { id: @js($target) })"
    >
        {{ $slot }}
    </div>
@else
    <button
        type="button"
        {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2', 'data-slot' => 'drawer-close']) }}
        @click="$dispatch('drawer-close', { id: @js($target) })"
    >
        {{ $slot }}
    </button>
@endif
