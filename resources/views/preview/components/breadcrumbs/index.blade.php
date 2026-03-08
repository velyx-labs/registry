@props([
    'props' => [],
])

@php
    $items = $props['items'] ?? [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Components', 'url' => '/components'],
        ['label' => 'Navigation', 'url' => '/components/navigation'],
        ['label' => 'Breadcrumbs'],
    ];

    $separator = (string) ($props['separator'] ?? '/');
    $homeIcon = filter_var($props['homeIcon'] ?? false, FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="preview relative flex h-[220px] w-full items-center justify-center p-6">
    <x-ui.breadcrumbs :items="$items" :separator="$separator" :home-icon="$homeIcon" class="max-w-lg" />
</div>
