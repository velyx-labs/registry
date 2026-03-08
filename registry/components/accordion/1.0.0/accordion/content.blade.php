<div x-show="isOpen($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue)" x-collapse x-cloak
    role="region" data-slot="accordion-content" data-orientation="vertical"
    :data-state="isOpen($el.closest('[data-slot=accordion-item]').dataset.accordionItemValue) ? 'open' : 'closed'"
    class="w-full max-w-full overflow-hidden text-sm">
    <div
        class="w-full min-w-0 max-w-full overflow-x-hidden break-words pt-0 pb-2.5 text-muted-foreground [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground [&_code]:break-all [&_p:not(:last-child)]:mb-4 [&_pre]:max-w-full [&_pre]:overflow-x-auto">
        {{ $slot }}
    </div>
</div>