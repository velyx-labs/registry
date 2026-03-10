@props([
    'position' => 'bottom-right',
    'duration' => 4000,
    'maxToasts' => 5,
])

@php
    $positionClasses = match ($position) {
        'top-left' => 'top-4 left-4',
        'top-center' => 'top-4 left-1/2 -translate-x-1/2',
        'top-right' => 'top-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'bottom-center' => 'bottom-4 left-1/2 -translate-x-1/2',
        'bottom-right' => 'bottom-4 right-4',
        default => 'bottom-4 right-4',
    };

    $isTop = str_starts_with($position, 'top');
@endphp

<div
    x-data="toast({ duration: {{ $duration }}, maxToasts: {{ $maxToasts }} })"
    x-on:toast.window="add(Array.isArray($event.detail) ? $event.detail[0] : $event.detail)"
    x-on:notify.window="add(Array.isArray($event.detail) ? $event.detail[0] : $event.detail)"
    class="pointer-events-none fixed z-[100] flex flex-col gap-2 {{ $positionClasses }}"
    data-test="toast-container"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 {{ $isTop ? '-translate-y-4' : 'translate-y-4' }} scale-95"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-y-0 scale-100 opacity-100"
            x-transition:leave-end="opacity-0 {{ $isTop ? '-translate-y-4' : 'translate-y-4' }} scale-95"
            class="bg-background pointer-events-auto w-80 max-w-sm overflow-hidden rounded-xl border shadow-lg"
            :class="getClasses(toast.type)"
            role="alert"
            data-test="toast-item"
        >
            <div class="p-4">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 shrink-0" :class="getIconClasses(toast.type)">
                        <template x-if="toast.type === 'success'"><x-lucide-check-circle class="size-5" /></template>
                        <template x-if="toast.type === 'error'"><x-lucide-x-circle class="size-5" /></template>
                        <template x-if="toast.type === 'warning'"><x-lucide-alert-triangle class="size-5" /></template>
                        <template x-if="toast.type === 'info' || !toast.type"><x-lucide-info class="size-5" /></template>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p x-show="toast.title" x-text="toast.title" class="text-sm font-semibold text-foreground"></p>
                        <p x-text="toast.message" class="text-sm text-muted-foreground" :class="{ 'mt-1': toast.title }"></p>
                    </div>

                    <button
                        type="button"
                        @click="remove(toast.id)"
                        class="hover:bg-foreground/10 shrink-0 rounded-lg p-1 transition-colors"
                    >
                        <x-lucide-x class="size-4 text-muted-foreground" />
                    </button>
                </div>
            </div>

            <div x-show="toast.duration > 0" class="h-1 bg-current opacity-20">
                <div class="h-full bg-current opacity-60" x-init="$el.style.animation = `shrink ${toast.duration}ms linear forwards`"></div>
            </div>
        </div>
    </template>
</div>

<style>
    @keyframes shrink {
        from { width: 100%; }
        to { width: 0%; }
    }
</style>
