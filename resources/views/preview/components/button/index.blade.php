@props([
    'props' => [],
])

@php
    $label = (string) ($props['label'] ?? 'Button');
    $variant = (string) ($props['variant'] ?? 'primary');
    $size = (string) ($props['size'] ?? 'md');
    $disabled = filter_var($props['disabled'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $icon = $props['icon'] ?? null;
    $iconRight = $props['iconRight'] ?? null;
    $pill = filter_var($props['pill'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $loading = filter_var($props['loading'] ?? false, FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="preview relative flex h-[220px] w-full items-center justify-center p-6">
    <x-ui.button
        :variant="$variant"
        :size="$size"
        :disabled="$disabled"
        :icon="$icon"
        :icon-right="$iconRight"
        :pill="$pill"
        :loading="$loading"
    >
        {{ $label }}
    </x-ui.button>
</div>
