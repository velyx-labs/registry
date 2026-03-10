@props([
    'id' => 'dialog',
    'size' => 'md',
    'closeable' => true,
    'title' => null,
    'footer' => null,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        'full' => 'max-w-full mx-4',
        default => 'max-w-md',
    };
@endphp

<div
    x-data="dialog({
        id: '{{ $id }}',
        closeable: {{ $closeable ? 'true' : 'false' }}
    })"
    x-on:open-dialog-{{ $id }}.window="open = true"
    x-on:close-dialog-{{ $id }}.window="open = false"
    @if($closeable)
        x-on:keydown.escape.window="handleKeydown($event)"
    @endif
    x-show="open"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    aria-labelledby="dialog-title"
    role="dialog"
    aria-modal="true"
>
    <div
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-background/80 backdrop-blur-sm transition-opacity"
        @if($closeable) @click="close()" @endif
    ></div>

    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="bg-background border-border relative w-full transform overflow-hidden rounded-lg border text-left shadow-xl transition-all sm:my-8 {{ $sizeClasses }}"
        >
            @if($title)
                <div class="border-border flex items-center justify-between border-b px-6 py-4">
                    <h3 class="text-lg font-semibold leading-6 text-foreground" id="dialog-title">
                        {{ $title }}
                    </h3>
                    @if($closeable)
                        <button @click="open = false" type="button" class="text-muted-foreground hover:text-foreground focus:outline-none transition-colors">
                            <x-lucide-x class="h-5 w-5" />
                        </button>
                    @endif
                </div>
            @endif

            <div class="px-6 py-4">
                {{ $slot }}
            </div>

            @if($footer)
                <div class="bg-muted/50 flex flex-row-reverse gap-2 px-6 py-4">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
