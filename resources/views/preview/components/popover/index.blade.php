@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="flex min-h-60 items-center justify-center">
        <x-ui.popover position="bottom" align="center" width="md">
            <x-slot:trigger_slot>
                <x-ui.button variant="outline">Open Popover</x-ui.button>
            </x-slot:trigger_slot>

            <x-slot:content>
                <div class="space-y-2">
                    <h4 class="text-sm font-semibold text-foreground">Dimensions</h4>
                    <p class="text-sm text-muted-foreground">Set dimensions for the layer.</p>
                </div>
            </x-slot:content>
        </x-ui.popover>
    </div>
</div>
