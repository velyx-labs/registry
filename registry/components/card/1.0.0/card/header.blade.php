<div data-slot="card-header" {{ $attributes->merge(['class' => 'grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 [&:has([data-slot=card-action])]:grid-cols-[1fr_auto]']) }}>
    {{ $slot }}
</div>