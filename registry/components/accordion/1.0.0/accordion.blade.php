@props([
    'items' => [],
    'multiple' => false,
    'defaultOpen' => null,
])

<div
    x-data="accordion({ multiple: {{ $multiple ? 'true' : 'false' }}, defaultOpen: {{ json_encode($defaultOpen) }} })"
    {{ $attributes->merge(['class' => 'w-full divide-y divide-border rounded-lg border border-border bg-background']) }}
>
    @foreach($items as $index => $item)
        <div class="w-full max-w-full">
            {{-- Accordion Header --}}
            <button
                type="button"
                @click="toggle({{ $index }})"
                :aria-expanded="isOpen({{ $index }})"
                class="flex w-full min-w-0 items-center justify-between gap-3 px-4 py-4 text-left font-medium text-foreground transition-colors hover:bg-accent"
            >
                <span class="min-w-0 flex-1 break-words">{{ $item['question'] ?? $item['title'] ?? 'Item ' . ($index + 1) }}</span>
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
                class="w-full max-w-full"
            >
                <div class="border-t border-border bg-muted/40 px-4 py-4">
                    <div class="prose prose-sm w-full min-w-0 max-w-full overflow-x-hidden break-words text-muted-foreground [&_code]:break-all [&_pre]:max-w-full [&_pre]:overflow-x-auto">
                        {!! $item['answer'] ?? $item['content'] ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
