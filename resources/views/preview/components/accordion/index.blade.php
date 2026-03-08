@props([
    'props' => [],
])

@php
    $items = $props['items'] ?? [
        [
            'question' => 'What is Velyx?',
            'answer' => 'Velyx is a UI component registry designed for Laravel applications.',
        ],
        [
            'question' => 'Does it support dark mode?',
            'answer' => 'Yes. Components are built to support both light and dark themes.',
        ],
        [
            'question' => 'Can I customize variants?',
            'answer' => 'Yes. Most components support variants and custom props for flexible rendering.',
        ],
    ];

    $multiple = filter_var($props['multiple'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $defaultOpen = $props['defaultOpen'] ?? 0;
@endphp

<x-ui.accordion
    :items="$items"
    :multiple="$multiple"
    :default-open="$defaultOpen"
/>
