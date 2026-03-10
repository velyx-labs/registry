@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="mx-auto grid w-full max-w-xl gap-5">
        <x-ui.progress-bar label="Setup progress" :percentage="25" variant="primary" />
        <x-ui.progress-bar label="Upload status" :percentage="62" variant="info" />
        <x-ui.progress-bar label="Deployment" :percentage="88" variant="success" size="lg" />
    </div>
</div>
