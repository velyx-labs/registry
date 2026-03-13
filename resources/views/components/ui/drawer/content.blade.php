@props([
    'showOverlay' => true,
])

<template x-teleport="body">
    <div x-show="open" x-cloak class="fixed inset-0 z-50" data-slot="drawer-portal">
        @if($showOverlay)
            <div
                x-show="open"
                x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/50"
                @click="closeDrawer()"
                data-slot="drawer-overlay"
            ></div>
        @endif

        <div class="fixed inset-x-0 bottom-0 z-50 mt-24 flex max-h-[96vh] flex-col rounded-t-xl border bg-background" data-slot="drawer-content">
            <div class="mx-auto mt-4 h-2 w-[100px] rounded-full bg-muted"></div>
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-full"
                x-transition:enter-end="translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-y-0"
                x-transition:leave-end="translate-y-full"
                class="flex flex-1 flex-col"
            >
                {{ $slot }}
            </div>
        </div>
    </div>
</template>
