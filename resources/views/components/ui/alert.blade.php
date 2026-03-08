@props([
    'variant' => 'default',
    'dismissible' => false,
    'title' => null,
    'icon' => null,
])

@php
    $defaultIcons = [
        'default' => 'info',
        'success' => 'check-circle',
        'destructive' => 'alert-circle',
        'warning' => 'alert-triangle',
        'info' => 'info',
    ];

    $iconName = $icon ?? ($defaultIcons[$variant] ?? 'info');

    $variantClasses = match ($variant) {
        'success' => 'bg-emerald-50 border-emerald-200 text-emerald-900',
        'destructive' => 'bg-destructive/10 border-destructive/20 text-destructive',
        'warning' => 'bg-amber-50 border-amber-200 text-amber-900',
        'info' => 'bg-blue-50 border-blue-200 text-blue-900',
        default => 'bg-muted border-border text-foreground',
    };

    $iconClasses = match ($variant) {
        'success' => 'text-emerald-600',
        'destructive' => 'text-destructive',
        'warning' => 'text-amber-600',
        'info' => 'text-blue-600',
        default => 'text-foreground',
    };

    $closeButtonClasses = match ($variant) {
        'success' => 'text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100',
        'destructive' => 'text-destructive hover:text-destructive/80 hover:bg-destructive/10',
        'warning' => 'text-amber-600 hover:text-amber-800 hover:bg-amber-100',
        'info' => 'text-blue-600 hover:text-blue-800 hover:bg-blue-100',
        default => 'text-muted-foreground hover:text-foreground hover:bg-accent',
    };
@endphp

<div
    x-data="alert({ dismissible: {{ $dismissible ? 'true' : 'false' }} })"
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    {{ $attributes->class([
        'relative w-full rounded-lg border p-4 flex gap-3 items-start',
        $variantClasses,
    ]) }}
    role="alert"
>
    <x-dynamic-component :component="'lucide-' . $iconName" class="size-5 shrink-0 {{ $iconClasses }}" />

    <div class="flex-1 min-w-0">
        @if($title)
            <h5 class="font-semibold leading-none tracking-tight mb-1">{{ $title }}</h5>
        @endif
        <div class="text-sm [&_p]:leading-relaxed">
            {{ $slot }}
        </div>
    </div>

    @if($dismissible)
        <button
            type="button"
            @click="close()"
            class="shrink-0 inline-flex items-center justify-center size-6 rounded-md transition-colors {{ $closeButtonClasses }}"
            aria-label="Close alert"
        >
            <x-lucide-x class="size-4" />
        </button>
    @endif
</div>
