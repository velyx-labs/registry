@props([
    'default' => null,
    'variant' => 'underline', // underline, pills, enclosed
])

@php
    $id = $attributes->get('id', 'tabs-' . uniqid());
@endphp

<div
    x-data="tabs({
        default: '{{ $default }}'
    })"
    {{ $attributes->merge(['class' => 'w-full']) }}
>
    {{ $slot }}
</div>
