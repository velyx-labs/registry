@props([
    'value',
])

<div
    class="w-full max-w-full not-last:border-b"
    data-slot="accordion-item"
    data-orientation="vertical"
    data-accordion-item-value="{{ (string) $value }}"
    :data-state="isOpen($el.dataset.accordionItemValue) ? 'open' : 'closed'"
>
    {{ $slot }}
</div>
