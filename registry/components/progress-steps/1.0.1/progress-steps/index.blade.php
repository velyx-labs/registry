@props([
    'steps' => [],
    'current' => 1,
    'variant' => 'default',
    'showLabels' => true,
    'showDescriptions' => true,
    'clickable' => false,
    'size' => 'md',
])

@php
    $totalSteps = count($steps);
    $currentStep = max(1, min((int) $current, max($totalSteps, 1)));

    $sizeClasses = [
        'sm' => ['dot' => 'h-6 w-6', 'icon' => 'h-3 w-3', 'label' => 'text-xs', 'description' => 'text-[11px]', 'bar' => 'h-1', 'lineTop' => 'top-3'],
        'md' => ['dot' => 'h-8 w-8', 'icon' => 'h-4 w-4', 'label' => 'text-sm', 'description' => 'text-xs', 'bar' => 'h-1.5', 'lineTop' => 'top-4'],
        'lg' => ['dot' => 'h-10 w-10', 'icon' => 'h-5 w-5', 'label' => 'text-base', 'description' => 'text-sm', 'bar' => 'h-2', 'lineTop' => 'top-5'],
    ];

    $sizes = $sizeClasses[$size] ?? $sizeClasses['md'];

    $variantColors = [
        'default' => [
            'completed' => 'bg-primary text-primary-foreground',
            'active' => 'bg-primary text-primary-foreground ring-4 ring-primary/30',
            'pending' => 'bg-muted text-muted-foreground',
            'bar-completed' => 'bg-primary',
            'bar-pending' => 'bg-muted',
        ],
        'success' => [
            'completed' => 'bg-emerald-500 text-white',
            'active' => 'bg-emerald-500 text-white ring-4 ring-emerald-500/30',
            'pending' => 'bg-muted text-muted-foreground',
            'bar-completed' => 'bg-emerald-500',
            'bar-pending' => 'bg-muted',
        ],
    ];

    $colors = $variantColors[$variant] ?? $variantColors['default'];
    $progressWidth = $totalSteps > 1 ? (($currentStep - 1) / ($totalSteps - 1)) * 100 : 0;
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="relative">
        @if($totalSteps > 1)
            <div class="absolute left-0 right-0 {{ $sizes['lineTop'] }} -translate-y-1/2 {{ $sizes['bar'] }} {{ $colors['bar-pending'] }} rounded-full"></div>

            <div
                class="absolute left-0 {{ $sizes['lineTop'] }} -translate-y-1/2 {{ $sizes['bar'] }} {{ $colors['bar-completed'] }} rounded-full transition-all duration-500 ease-out"
                style="width: {{ $progressWidth }}%"
            ></div>
        @endif

        <div class="relative z-10 grid gap-2" style="grid-template-columns: repeat({{ max($totalSteps, 1) }}, minmax(0, 1fr));">
            @foreach($steps as $index => $step)
                <x-ui.progress-steps.step
                    :step="$step"
                    :step-number="$index + 1"
                    :current-step="$currentStep"
                    :clickable="$clickable"
                    :show-labels="$showLabels"
                    :show-descriptions="$showDescriptions"
                    :sizes="$sizes"
                    :colors="$colors"
                />
            @endforeach
        </div>
    </div>
</div>
