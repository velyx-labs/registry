@props([
    'props' => [],
])

@php
    $variant = (string) ($props['variant'] ?? 'vertical');
    $items = [
        ['title' => 'Foundation shipped', 'description' => 'Core components stabilized for production use.', 'date' => 'March 2', 'type' => 'release'],
        ['title' => 'Docs refreshed', 'description' => 'Preview and source code now stay aligned.', 'date' => 'March 6', 'type' => 'feature'],
        ['title' => 'CLI tightened', 'description' => 'Nested component exports and JS imports were fixed.', 'date' => 'March 10', 'type' => 'fix'],
    ];
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-4xl rounded-xl border border-border bg-card p-6">
        <x-ui.timeline :items="$items" :variant="$variant" />
    </div>
</div>
