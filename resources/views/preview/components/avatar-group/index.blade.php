@props([
    'props' => [],
])

@php
    $avatars = $props['avatars'] ?? [
        ['src' => 'https://i.pravatar.cc/128?img=11', 'name' => 'Jane Cooper', 'status' => 'online'],
        ['src' => 'https://i.pravatar.cc/128?img=12', 'name' => 'Devon Lane', 'status' => 'online'],
        ['src' => 'https://i.pravatar.cc/128?img=13', 'name' => 'Robert Fox', 'status' => 'away'],
        ['src' => 'https://i.pravatar.cc/128?img=14', 'name' => 'Wade Warren', 'status' => 'busy'],
        ['src' => 'https://i.pravatar.cc/128?img=15', 'name' => 'Darlene Robertson', 'status' => 'offline'],
    ];

    $max = (int) ($props['max'] ?? 4);
    $size = (string) ($props['size'] ?? 'lg');
    $shape = (string) ($props['shape'] ?? 'circle');
@endphp

<div class="preview relative flex h-[220px] w-full items-center justify-center p-6">
    <div class="flex flex-col items-center gap-3">
        <x-ui.avatar-group :avatars="$avatars" :max="$max" :size="$size" :shape="$shape" />
        <p class="text-xs text-muted-foreground">Team members</p>
    </div>
</div>
