@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between rounded-lg border border-border p-4">
            <span class="text-sm text-muted-foreground">Open command palette</span>
            <x-ui.kbd keys="cmd+k" />
        </div>

        <div class="flex items-center justify-between rounded-lg border border-border p-4">
            <span class="text-sm text-muted-foreground">Navigate tabs</span>
            <x-ui.kbd :keys="['ctrl', 'shift', 'right']" variant="outline" />
        </div>

        <div class="flex items-center justify-between rounded-lg border border-border p-4">
            <span class="text-sm text-muted-foreground">Submit form</span>
            <x-ui.kbd keys="enter" size="lg" />
        </div>
    </div>
</div>
