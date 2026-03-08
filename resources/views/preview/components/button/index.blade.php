@props([
    'props' => [],
])

@php
    $label = (string) ($props['label'] ?? 'Button');
    $variant = (string) ($props['variant'] ?? 'primary');
    $size = (string) ($props['size'] ?? 'md');
    $disabled = filter_var($props['disabled'] ?? false, FILTER_VALIDATE_BOOLEAN);
@endphp

<x-ui.button :variant="$variant" :size="$size" :disabled="$disabled">
    {{ $label }}
</x-ui.button>
