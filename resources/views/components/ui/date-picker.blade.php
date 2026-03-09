@props([
    'placeholder' => 'Select a date',
    'disabled' => false,
    'icon' => 'calendar',
    'clearable' => true,
    'size' => 'md',
    'minDate' => null,
    'maxDate' => null,
])

@php
    $sizeClasses = match($size) {
        'sm' => 'h-8 text-sm px-2.5',
        'lg' => 'h-12 text-base px-4',
        default => 'h-10 text-sm px-3',
    };

    $iconSize = match($size) {
        'sm' => 'size-3.5',
        'lg' => 'size-5',
        default => 'size-4',
    };

    $wireModel = $attributes->wire('model')->value();
@endphp

<div
    x-data="datePicker(@if($wireModel) @entangle($attributes->wire('model')).live @else null @endif)"
    x-init="minDate = '{{ $minDate }}'; maxDate = '{{ $maxDate }}'"
    @click.away="open = false"
    @keydown.escape.window="open = false"
    class="relative"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <div class="relative">
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

    <div
        x-show="open"
        x-cloak
        x-transition.opacity.duration.150ms
        class="bg-popover border-border absolute z-50 mt-2 w-72 rounded-xl border p-4 shadow-lg"
    >
        <div class="mb-4 flex items-center justify-between">
            <button type="button" @click.stop="prevMonth()" class="hover:bg-accent rounded-lg p-1.5 transition-colors">
                <x-dynamic-component component="lucide-chevron-left" class="text-muted-foreground size-4" />
            </button>
            <span class="text-foreground text-sm font-semibold" x-text="monthNames[viewMonth] + ' ' + viewYear"></span>
            <button type="button" @click.stop="nextMonth()" class="hover:bg-accent rounded-lg p-1.5 transition-colors">
                <x-dynamic-component component="lucide-chevron-right" class="text-muted-foreground size-4" />
            </button>
        </div>

        <div class="mb-2 grid grid-cols-7">
            <template x-for="day in ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']">
                <div class="text-muted-foreground py-1 text-center text-xs font-medium" x-text="day"></div>
            </template>
        </div>

        <div class="grid grid-cols-7 gap-0.5">
            <template x-for="i in emptyDays">
                <div class="h-8"></div>
            </template>

            <template x-for="day in daysInMonth">
                <button
                    type="button"
                    @click.stop="selectDate(day)"
                    x-text="day"
                    :disabled="isDisabled(day)"
                    :class="{
                        'bg-primary text-primary-foreground': isSelected(day),
                        'ring-1 ring-primary': isToday(day) && !isSelected(day),
                        'hover:bg-accent': !isSelected(day) && !isDisabled(day),
                        'opacity-30 cursor-not-allowed': isDisabled(day)
                    }"
                    class="h-8 w-full rounded-md text-sm transition-colors"
                ></button>
            </template>
        </div>

        <div class="border-border mt-3 border-t pt-3">
            <button
                type="button"
                @click.stop="goToday()"
                class="text-primary hover:bg-accent w-full rounded-lg py-1.5 text-sm font-medium transition-colors"
            >
                Today
            </button>
        </div>
    </div>
</div>
