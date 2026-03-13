@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="mx-auto grid w-full max-w-xl gap-6">
        <div class="rounded-lg border border-border p-4">
            <p class="mb-3 text-sm text-muted-foreground">Interactive</p>
            <x-ui.rating show-value="true" />
        </div>

        <div class="rounded-lg border border-border p-4">
            <p class="mb-3 text-sm text-muted-foreground">Readonly</p>
            <x-ui.rating :readonly="true" :show-value="true" variant="primary" x-data="{}" />
        </div>
    </div>
</div>
