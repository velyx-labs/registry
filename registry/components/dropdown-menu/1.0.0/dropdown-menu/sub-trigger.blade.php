@props([
    'inset' => false,
])

<button
    type="button"
    @click="subOpen = !subOpen"
    {{ $attributes->merge(['class' => 'flex w-full cursor-default items-center rounded-sm px-2 py-1.5 text-sm outline-hidden select-none hover:bg-accent data-[state=open]:bg-accent']) }}
    @class(['pl-8' => $inset])
    :data-state="subOpen ? 'open' : 'closed'"
    data-slot="dropdown-menu-sub-trigger"
>
    <span>{{ $slot }}</span>
    <x-lucide-chevron-right class="ml-auto size-4" />
</button>
