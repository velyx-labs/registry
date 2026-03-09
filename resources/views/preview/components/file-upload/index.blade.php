@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-2xl">
        <x-ui.file-upload
            label="Upload assets"
            description="PNG, JPG, or WEBP up to 10MB"
            accept="image/*"
            multiple="true"
            max-size="10MB"
        />
    </div>
</div>
