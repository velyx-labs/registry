@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="max-w-sm space-y-4">
        <x-ui.date-picker
            placeholder="Select a date"
            :clearable="true"
            min-date="2026-01-01"
            max-date="2026-12-31"
        />
    </div>
</div>
