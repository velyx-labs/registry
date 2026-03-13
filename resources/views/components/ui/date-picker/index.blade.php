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
    <x-ui.date-picker.input
        :placeholder="$placeholder"
        :disabled="$disabled"
        :icon="$icon"
        :clearable="$clearable"
        :icon-size="$iconSize"
        :size-classes="$sizeClasses"
    />

    <x-ui.date-picker.calendar />
</div>
