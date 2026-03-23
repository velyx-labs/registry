@props([
    'as' => 'div',
])

<{{ $as }}
    class="flex-1 min-w-0"
    {{ $attributes->merge(['class' => 'flex-1 min-w-0']) }}
>
    {{ $slot }}
</{{ $as }}>