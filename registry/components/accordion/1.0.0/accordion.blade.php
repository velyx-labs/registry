@props([
    'items' => [],
    'multiple' => false,
    'defaultOpen' => null,
])

<div
    x-data="accordion({ multiple: {{ $multiple ? 'true' : 'false' }}, defaultOpen: {{ json_encode($defaultOpen) }} })"
    {{ $attributes->merge(['class' => 'divide-y divide-border rounded-lg border border-border bg-background']) }}
>
    @foreach($items as $index => $item)
        <div class="accordion-item">
            {{-- Accordion Header --}}
            <button
                type="button"
                @click="toggle({{ $index }})"
                :aria-expanded="isOpen({{ $index }})"
                class="flex w-full items-center justify-between px-4 py-4 text-left font-medium text-foreground transition-colors hover:bg-accent"
            >
                <span>{{ $item['question'] ?? $item['title'] ?? 'Item ' . ($index + 1) }}</span>
                <span
                    :class="{ 'rotate-180': isOpen({{ $index }}) }"
                    class="ml-2 shrink-0 text-muted-foreground transition-transform duration-200"
                >
                    <x-dynamic-component component="lucide-chevron-down" class="h-5 w-5" />
                </span>
            </button>

            {{-- Accordion Content --}}
            <div
                x-show="isOpen({{ $index }})"
                x-collapse
                x-cloak
            >
                <div class="border-t border-border bg-muted/40 px-4 py-4">
                    <div class="prose prose-sm max-w-none text-muted-foreground">
                        {!! $item['answer'] ?? $item['content'] ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
