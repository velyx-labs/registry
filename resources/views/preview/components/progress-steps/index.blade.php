@props([
    'props' => [],
])

@php
    $variant = (string) ($props['variant'] ?? 'default');
    $current = (int) ($props['current'] ?? 2);
    $steps = [
        ['label' => 'Planning', 'description' => 'Define scope', 'icon' => 'clipboard-list'],
        ['label' => 'Design', 'description' => 'Review UI', 'icon' => 'palette'],
        ['label' => 'Build', 'description' => 'Ship code', 'icon' => 'code'],
        ['label' => 'Launch', 'description' => 'Go live', 'icon' => 'rocket'],
    ];
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-3xl">
        <x-ui.progress-steps :steps="$steps" :current="$current" :variant="$variant" />
    </div>
</div>
