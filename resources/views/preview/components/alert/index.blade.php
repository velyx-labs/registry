@props([
    'props' => [],
])
@php
    $variant = (string) ($props['variant'] ?? 'default');
    $dismissible = filter_var($props['dismissible'] ?? true, FILTER_VALIDATE_BOOLEAN);
    $title = (string) ($props['title'] ?? 'Update available');
    $message = (string) ($props['message'] ?? 'A new version is available. Please update to get the latest improvements.');
@endphp

<div class="preview relative flex h-[260px] w-full items-start justify-center p-6 [&_[role=alert]]:max-w-lg">
    <x-ui.alert :variant="$variant" :dismissible="$dismissible" :title="$title">
        {{ $message }}
    </x-ui.alert>
</div>
