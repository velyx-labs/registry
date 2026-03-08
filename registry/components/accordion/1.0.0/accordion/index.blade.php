@props([
    'type' => 'single',
    'collapsible' => false,
    'defaultValue' => null,
    'items' => [],
    'multiple' => null,
    'defaultOpen' => null,
])

@php
    $resolvedType = $multiple !== null
        ? ($multiple ? 'multiple' : 'single')
        : $type;

    $resolvedCollapsible = $resolvedType === 'multiple'
        ? true
        : (bool) $collapsible;

    $resolvedDefaultValue = $defaultValue ?? $defaultOpen;

    if ($resolvedType === 'multiple') {
        if ($resolvedDefaultValue === null) {
            $resolvedDefaultValue = [];
        } elseif (! is_array($resolvedDefaultValue)) {
            $resolvedDefaultValue = [$resolvedDefaultValue];
        }
    } elseif (is_array($resolvedDefaultValue)) {
        $resolvedDefaultValue = $resolvedDefaultValue[0] ?? null;
    }

    $hasSlotContent = trim((string) $slot) !== '';
@endphp

<div
    x-data="accordion({
        type: @js($resolvedType),
        collapsible: {{ $resolvedCollapsible ? 'true' : 'false' }},
        defaultValue: @js($resolvedDefaultValue),
    })"
    data-slot="accordion"
    data-orientation="vertical"
    {{ $attributes->merge(['class' => 'flex flex-col w-full divide-y divide-border rounded-lg bg-background']) }}
>
    @if($hasSlotContent)
        {{ $slot }}
    @else
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
    @endif
</div>