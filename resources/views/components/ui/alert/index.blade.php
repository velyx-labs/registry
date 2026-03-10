@props([
    'variant' => 'default',
    'dismissible' => false,
    'title' => null,
    'icon' => null,
])

@php
    $defaultIcons = [
        'default' => 'info',
        'primary' => 'info',
        'secondary' => 'circle-alert',
        'destructive' => 'alert-circle',
        'outline' => 'info',
        'ghost' => 'info',
        'success' => 'info',
        'warning' => 'circle-alert',
        'info' => 'info',
    ];

    $iconName = $icon ?? ($defaultIcons[$variant] ?? 'info');

    $variantClasses = match ($variant) {
        'primary', 'success', 'info' => 'bg-primary/10 border-primary/20 text-foreground',
        'secondary', 'warning' => 'bg-secondary/20 border-secondary/40 text-secondary-foreground',
        'destructive' => 'bg-destructive/10 border-destructive/20 text-destructive',
        'outline' => 'bg-transparent border-border text-foreground',
        'ghost' => 'bg-transparent border-transparent text-foreground',
        'default' => 'bg-muted border-border text-foreground',
        default => 'bg-muted border-border text-foreground',
    };

    $iconClasses = match ($variant) {
        'primary', 'success', 'info' => 'text-primary',
        'secondary', 'warning' => 'text-secondary-foreground',
        'destructive' => 'text-destructive',
        'outline', 'ghost' => 'text-muted-foreground',
        'default' => 'text-foreground',
        default => 'text-foreground',
    };

    $closeButtonClasses = match ($variant) {
        'primary', 'success', 'info' => 'text-primary hover:text-primary/80 hover:bg-primary/10',
        'secondary', 'warning' => 'text-secondary-foreground hover:text-secondary-foreground/80 hover:bg-secondary/30',
        'destructive' => 'text-destructive hover:text-destructive/80 hover:bg-destructive/10',
        'outline', 'ghost' => 'text-muted-foreground hover:text-foreground hover:bg-accent',
        'default' => 'text-muted-foreground hover:text-foreground hover:bg-accent',
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
