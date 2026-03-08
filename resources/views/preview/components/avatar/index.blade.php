@props([
    'props' => [],
])

@php
    $src = $props['src'] ?? 'https://i.pravatar.cc/128?img=12';
    $name = (string) ($props['name'] ?? 'Jane Cooper');
    $size = (string) ($props['size'] ?? 'xl');
    $shape = (string) ($props['shape'] ?? 'circle');
    $status = $props['status'] ?? 'online';
    $fallbackIcon = (string) ($props['fallbackIcon'] ?? 'user');
@endphp

<div class="preview relative flex h-[220px] w-full items-center justify-center p-6">
    <div class="flex items-center gap-4">
        <x-ui.avatar
            :src="$src"
            :name="$name"
            :size="$size"
            :shape="$shape"
            :status="$status"
            :fallback-icon="$fallbackIcon"
        />

        <div class="space-y-1">
            <p class="text-sm font-medium text-foreground">{{ $name }}</p>
            <p class="text-xs text-muted-foreground">{{ ucfirst((string) $status) }}</p>
        </div>
    </div>
</div>
