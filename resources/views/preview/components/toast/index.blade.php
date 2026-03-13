@props([
    'props' => [],
])

<div class="preview w-full p-6" x-data>
    <x-ui.toast position="bottom-right" :duration="3500" :max-toasts="4" />

    <div class="flex flex-wrap gap-2">
        <x-ui.button @click="$dispatch('toast', { type: 'success', title: 'Saved', message: 'Your changes were saved.' })">Success</x-ui.button>
        <x-ui.button variant="outline" @click="$dispatch('toast', { type: 'info', title: 'Heads up', message: 'A new update is available.' })">Info</x-ui.button>
        <x-ui.button variant="outline" @click="$dispatch('toast', { type: 'warning', title: 'Careful', message: 'Storage is almost full.' })">Warning</x-ui.button>
        <x-ui.button variant="destructive" @click="$dispatch('toast', { type: 'error', title: 'Failed', message: 'Unable to complete this action.' })">Error</x-ui.button>
    </div>
</div>
