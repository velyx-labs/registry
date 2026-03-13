@props([
    'open' => false,
    'closeOnEscape' => true,
])

<div
    x-data="drawer({ open: {{ $open ? 'true' : 'false' }} })"
    @drawer-open.window="handleOpenEvent($event)"
    @drawer-close.window="handleCloseEvent($event)"
    @drawer-toggle.window="handleToggleEvent($event)"
    @if($closeOnEscape) @keydown.escape.window="closeDrawer()" @endif
    {{ $attributes->merge(['class' => 'relative']) }}
    data-slot="drawer"
>
    {{ $slot }}
</div>
