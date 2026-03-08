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
    $type = $multiple ? 'multiple' : 'single';
    $collapsible = filter_var($props['collapsible'] ?? true, FILTER_VALIDATE_BOOLEAN);
    $defaultValue = $props['defaultValue'] ?? ($props['defaultOpen'] ?? 'item-1');
@endphp

<div class="preview relative flex h-[300px] w-full justify-center items-start p-10 [&_[data-slot=accordion]]:max-w-sm">
    <x-ui.accordion
        :type="$type"
        :collapsible="$collapsible"
        :default-value="$defaultValue"
        class="max-w-lg"
    >
        @foreach($items as $index => $item)
            @php($itemValue = (string) ($item['value'] ?? 'item-'.($index + 1)))

            <x-ui.accordion.item :value="$itemValue">
                <x-ui.accordion.trigger>
                    {{ $item['question'] ?? $item['title'] ?? 'Item '.($index + 1) }}
                </x-ui.accordion.trigger>

                <x-ui.accordion.content>
                    {!! $item['answer'] ?? $item['content'] ?? '' !!}
                </x-ui.accordion.content>
            </x-ui.accordion.item>
        @endforeach
    </x-ui.accordion>
</div>
