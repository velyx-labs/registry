@props([
    'placeholder' => 'Select a date',
    'disabled' => false,
    'icon' => 'calendar',
    'clearable' => true,
    'iconSize' => 'size-4',
    'sizeClasses' => 'h-10 text-sm px-3',
])

<div class="relative" data-slot="date-picker-input">
    <div class="pointer-events-none absolute top-1/2 left-3 -translate-y-1/2 text-muted-foreground">
        <x-dynamic-component :component="'lucide-' . $icon" class="{{ $iconSize }}" />
    </div>

    <input
        type="text"
        :value="displayValue"
        @click="toggle()"
        placeholder="{{ $placeholder }}"
        readonly
        @disabled($disabled)
        class="border-input bg-background text-foreground placeholder:text-muted-foreground focus:ring-ring focus:ring-offset-background w-full cursor-pointer rounded-lg border pr-10 pl-10 focus:ring-2 focus:ring-offset-2 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 {{ $sizeClasses }}"
    />

    @if($clearable)
        <button
            type="button"
            x-show="value"
            x-cloak
            @click.stop="clear()"
            class="text-muted-foreground hover:text-foreground hover:bg-accent absolute top-1/2 right-3 -translate-y-1/2 rounded p-1 transition-colors"
        >
            <x-dynamic-component component="lucide-x" class="{{ $iconSize }}" />
        </button>
    @endif
</div>
