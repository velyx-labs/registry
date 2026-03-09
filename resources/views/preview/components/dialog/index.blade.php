@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <x-ui.button x-on:click="$dispatch('open-dialog-preview-dialog')">Open Dialog</x-ui.button>

    <x-ui.dialog id="preview-dialog" title="Delete project" size="md">
        <p class="text-sm text-muted-foreground">
            This action cannot be undone. This will permanently delete your project and associated data.
        </p>

        <div class="mt-6 flex justify-end gap-2">
            <x-ui.button variant="outline" x-on:click="$dispatch('close-dialog-preview-dialog')">Cancel</x-ui.button>
            <x-ui.button variant="destructive">Delete</x-ui.button>
        </div>
    </x-ui.dialog>
</div>
