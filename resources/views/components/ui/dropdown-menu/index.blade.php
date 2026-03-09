@props([
    'open' => false,
])

<div
    x-data="dropdown({ open: {{ $open ? 'true' : 'false' }} })"
    @keydown.escape.window="closeMenu()"
    {{ $attributes->merge(['class' => 'relative inline-flex']) }}
    data-slot="dropdown-menu"
>
    {{ $slot }}
</div>
