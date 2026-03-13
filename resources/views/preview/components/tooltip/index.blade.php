@props([
    'props' => [],
])

@php
    $position = (string) ($props['position'] ?? 'top');
    $arrow = filter_var($props['arrow'] ?? true, FILTER_VALIDATE_BOOLEAN);
    $delay = (int) ($props['delay'] ?? 200);
@endphp

<div class="preview flex h-[240px] w-full items-center justify-center p-6">
    <div class="flex flex-wrap items-center justify-center gap-4">
        <x-ui.tooltip content="Velyx keeps component APIs sharp and copy-paste friendly." :position="$position" :delay="$delay" :arrow="$arrow">
            <x-ui.button variant="outline">Hover me</x-ui.button>
        </x-ui.tooltip>

        <div class="max-w-xs text-sm text-muted-foreground">
            Tooltips help when the UI needs short supporting context without taking permanent space.
        </div>
    </div>
</div>
