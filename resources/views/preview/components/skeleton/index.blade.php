@props([
    'props' => [],
])

@php
    $variant = (string) ($props['variant'] ?? 'text');
    $count = (int) ($props['count'] ?? 1);
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto flex w-full max-w-xl flex-col gap-4 rounded-xl border border-border bg-card p-5">
        <div class="flex items-center gap-3">
            <x-ui.skeleton variant="avatar" />
            <div class="flex-1 space-y-2">
                <x-ui.skeleton variant="title" class="w-40" />
                <x-ui.skeleton variant="text" class="w-56" />
            </div>
        </div>

        @if ($variant === 'card')
            <x-ui.skeleton variant="card" class="h-36" />
        @elseif ($count > 1)
            <x-ui.skeleton variant="text" :count="$count" />
        @else
            <x-ui.skeleton :variant="$variant" />
        @endif
    </div>
</div>
