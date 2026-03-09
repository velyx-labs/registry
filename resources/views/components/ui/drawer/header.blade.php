<div {{ $attributes->merge(['class' => 'flex flex-col gap-1.5 p-4 text-center sm:text-left']) }}
    data-slot="drawer-header">
    {{ $slot }}
</div>