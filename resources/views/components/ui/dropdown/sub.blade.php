<div x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false" class="relative"
    data-slot="dropdown-menu-sub">
    {{ $slot }}
</div>