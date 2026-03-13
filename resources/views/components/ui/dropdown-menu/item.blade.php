@props([
    'disabled' => false,
    'inset' => false,
    'closeOnSelect' => true,
])

<button
    type="button"
    @if($closeOnSelect) @click="closeMenu()" @endif
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'relative flex w-full cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 hover:bg-accent hover:text-accent-foreground']) }}
    @if($disabled) data-disabled="true" @endif
    @class(['pl-8' => $inset])
    data-slot="dropdown-menu-item"
>
    {{ $slot }}
</button>
