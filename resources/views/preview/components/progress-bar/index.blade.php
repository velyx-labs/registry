@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-md rounded-xl border border-border bg-card p-6 shadow-sm">
        <div class="space-y-5">
            <x-ui.progress-bar label="Setup progress" :percentage="25" variant="primary" />
            <x-ui.progress-bar label="Upload status" :percentage="62" variant="secondary" />
            <x-ui.progress-bar label="Deployment" :percentage="88" variant="destructive" size="lg" />
        </div>
    </div>
</div>
