@props([
    'props' => [],
])

@php
    $variant = (string) ($props['variant'] ?? 'default');
    $size = (string) ($props['size'] ?? 'md');
    $pill = filter_var($props['pill'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $icon = $props['icon'] ?? null;
    $removable = filter_var($props['removable'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $label = (string) ($props['label'] ?? 'Badge');
@endphp

<div class="preview relative flex h-[220px] w-full items-center justify-center p-6">
    <div class="flex items-center gap-3">
        <x-ui.badge
            :variant="$variant"
            :size="$size"
            :pill="$pill"
            :icon="$icon"
            :removable="$removable"
        >
            {{ $label }}
        </x-ui.badge>
    </div>
</div>
