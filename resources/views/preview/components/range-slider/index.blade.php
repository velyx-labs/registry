@props([
    'props' => [],
])

@php
    $type = (string) ($props['type'] ?? 'single');
    $size = (string) ($props['size'] ?? 'md');
    $variant = (string) ($props['variant'] ?? 'default');
    $showValue = ! array_key_exists('showValue', $props) || filter_var($props['showValue'], FILTER_VALIDATE_BOOLEAN);
    $showLabels = ! array_key_exists('showLabels', $props) || filter_var($props['showLabels'], FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-2xl rounded-xl border border-border bg-card p-5">
        <div class="mb-4 flex items-start justify-between gap-3">
            <div>
                <p class="text-sm font-medium text-foreground">Project range</p>
                <p class="text-sm text-muted-foreground">Adjust thresholds for filtering analytics and segmenting results.</p>
            </div>
            <span class="rounded-full border border-border bg-muted px-2.5 py-1 text-xs font-medium text-muted-foreground">
                {{ ucfirst($type) }}
            </span>
        </div>

        <x-ui.range-slider
            :type="$type"
            :size="$size"
            :variant="$variant"
            :show-value="$showValue"
            :show-labels="$showLabels"
            :min="0"
            :max="100"
            :step="5"
        />
    </div>
</div>
