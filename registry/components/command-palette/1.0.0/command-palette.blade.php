@props([
    'open' => false,
    'placeholder' => 'Search commands, files...',
])

<div
    x-data="commandPalette({ open: {{ $open ? 'true' : 'false' }} })"
    x-show="open"
    x-on:keydown.meta.k.window.prevent="openPalette()"
    x-on:keydown.ctrl.k.window.prevent="openPalette()"
    x-on:keydown.escape.window="closePalette()"
    x-cloak
    class="relative z-50"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div
        x-show="open"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-foreground/50 backdrop-blur-sm"
        @click="closePalette()"
    ></div>

    {{-- Modal --}}
    <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 md:p-20">
        <div
            x-show="open"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-background text-foreground ring-border mx-auto max-w-2xl transform overflow-hidden rounded-xl border shadow-2xl ring-1"
        >
            {{-- Search Input --}}
            <div class="relative">
                <x-lucide-search class="text-muted-foreground pointer-events-none absolute left-4 top-3.5 h-5 w-5" />
                <input
                    type="text"
                    x-ref="searchInput"
                    x-init="$watch('open', value => { if (value) { $nextTick(() => $refs.searchInput.focus()) } })"
                    class="text-foreground placeholder:text-muted-foreground h-12 w-full border-0 bg-transparent pl-11 pr-4 focus:ring-0 sm:text-sm"
                    placeholder="{{ $placeholder }}"
                    role="combobox"
                    aria-expanded="true"
                >
                <kbd class="bg-muted text-muted-foreground border-border absolute right-4 top-3 hidden rounded border px-2 py-1 text-xs sm:block">
                    ESC
                </kbd>
            </div>

            {{-- Results --}}
            <div class="border-border max-h-80 scroll-py-2 overflow-y-auto border-t">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            <div class="border-border bg-muted/40 text-muted-foreground flex flex-wrap items-center gap-x-4 gap-y-2 border-t px-4 py-2.5 text-xs">
                <span class="flex items-center gap-1">
                    <kbd class="bg-muted border-border rounded border px-1.5 py-0.5 font-mono">↑↓</kbd>
                    Navigate
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="bg-muted border-border rounded border px-1.5 py-0.5 font-mono">↵</kbd>
                    Select
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="bg-muted border-border rounded border px-1.5 py-0.5 font-mono">esc</kbd>
                    Close
                </span>
            </div>
        </div>
    </div>
</div>
