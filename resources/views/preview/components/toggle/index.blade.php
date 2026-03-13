@props([
    'props' => [],
])

@php
    $size = (string) ($props['size'] ?? 'md');
    $checked = filter_var($props['checked'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $disabled = filter_var($props['disabled'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $description = filter_var($props['description'] ?? false, FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto flex w-full max-w-xl flex-col gap-4">
        <x-ui.toggle
            label="Email notifications"
            :size="$size"
            :checked="$checked"
            :disabled="$disabled"
            :description="$description ? 'Get updates about releases, security notices, and team activity.' : null"
        />

        <div class="rounded-lg border border-dashed border-border bg-card/40 p-4 text-sm text-muted-foreground">
            Use the toggle for boolean settings, quick preferences, and permission switches.
        </div>
    </div>
</div>
