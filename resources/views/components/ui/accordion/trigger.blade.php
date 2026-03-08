@props([
    'as' => 'h3',
])

<{{ $as }} class="flex" data-orientation="vertical" :data-state="isOpen($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue) ? 'open' : 'closed'">
    <button
        type="button"
        @click="toggle($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue)"
        :aria-expanded="isOpen($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue)"
        data-slot="accordion-trigger"
        data-orientation="vertical"
        :data-state="isOpen($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue) ? 'open' : 'closed'"
        @class([
            'group/accordion-trigger relative flex w-full min-w-0 flex-1 items-start justify-between rounded-lg border border-transparent py-2.5 text-left text-sm font-medium transition-all outline-none hover:underline focus-visible:border-ring focus-visible:ring-3 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50',
            $attributes->get('class'),
        ])
        {{ $attributes->except('class') }}
    >
        <span class="min-w-0 flex-1 break-words">{{ $slot }}</span>

        <x-dynamic-component
            component="lucide-chevron-down"
            data-slot="accordion-trigger-icon"
            x-show="!isOpen($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue)"
            class="pointer-events-none ml-auto size-4 shrink-0 text-muted-foreground"
        />
        <x-dynamic-component
            component="lucide-chevron-up"
            data-slot="accordion-trigger-icon"
            x-show="isOpen($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue)"
            class="pointer-events-none ml-auto size-4 shrink-0 text-muted-foreground"
        />
    </button>
</{{ $as }}>
