@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <x-ui.dialog id="confirm-dialog" title="Delete project">
        <p class="text-sm text-muted-foreground">
            This action cannot be undone. This will permanently delete the project and remove all related data.
        </p>

        <x-slot:footer>
            <x-ui.button variant="destructive">Delete</x-ui.button>
            <x-ui.button
                variant="outline"
                @click="$dispatch('close-dialog-confirm-dialog')"
            >
                Cancel
            </x-ui.button>
        </x-slot:footer>
    </x-ui.dialog>

    <div class="mt-4 flex justify-center">
        <x-ui.button @click="$dispatch('open-dialog-confirm-dialog')">Open Dialog</x-ui.button>
    </div>
</div>
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
