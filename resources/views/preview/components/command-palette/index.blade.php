@props([
    'props' => [],
])

@php
    $placeholder = (string) ($props['placeholder'] ?? 'Search commands, files...');
@endphp

<div class="preview relative flex h-[520px] w-full items-start justify-center p-6">
    <x-ui.command-palette :open="true" :placeholder="$placeholder">
        <ul class="p-2">
            <li class="text-foreground hover:bg-muted rounded-md px-3 py-2 text-sm">
                Open settings
            </li>
            <li class="text-foreground hover:bg-muted rounded-md px-3 py-2 text-sm">
                Search components
            </li>
            <li class="text-foreground hover:bg-muted rounded-md px-3 py-2 text-sm">
                Go to dashboard
            </li>
        </ul>
    </x-ui.command-palette>
</div>
