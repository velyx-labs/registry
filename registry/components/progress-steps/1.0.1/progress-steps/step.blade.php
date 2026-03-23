@props([
    'step' => [],
    'stepNumber',
    'currentStep',
    'clickable' => false,
    'showLabels' => true,
    'showDescriptions' => true,
    'sizes' => [],
    'colors' => [],
])

@php
    $isCompleted = $stepNumber < $currentStep;
    $isActive = $stepNumber === $currentStep;

    $dotClass = match (true) {
        $isCompleted => $colors['completed'],
        $isActive => $colors['active'],
        default => $colors['pending'],
    };

    $cursorClass = ($clickable && $stepNumber <= $currentStep) ? 'cursor-pointer hover:scale-105' : 'cursor-default';
    $buttonClasses = "mx-auto flex items-center justify-center rounded-full transition-all duration-300 {$sizes['dot']} {$dotClass} {$cursorClass}";
    $labelClasses = $sizes['label'].' font-medium '.(($isCompleted || $isActive) ? 'text-foreground' : 'text-muted-foreground');

    $label = isset($step['label']) ? (string) $step['label'] : null;
    $description = isset($step['description']) ? (string) $step['description'] : null;
    $icon = isset($step['icon']) ? (string) $step['icon'] : null;
@endphp

<div class="min-w-0 text-center">
    <button
        type="button"
        @if($clickable && $stepNumber <= $currentStep)
            wire:click="setProjectStep({{ $stepNumber }})"
        @endif
        class="{{ $buttonClasses }}"
    >
        @if($isCompleted)
            <x-lucide-check class="{{ $sizes['icon'] }}" />
        @elseif($icon)
            <x-dynamic-component :component="'lucide-' . $icon" class="{{ $sizes['icon'] }}" />
        @else
            <span class="{{ $sizes['label'] }} font-semibold">{{ $stepNumber }}</span>
        @endif
    </button>

    @if($showLabels && $label)
        <div class="mt-2 space-y-0.5 px-1">
            <p class="{{ $labelClasses }} break-words leading-tight">{{ $label }}</p>
            @if($showDescriptions && filled($description))
                <p class="{{ $sizes['description'] }} text-muted-foreground break-words leading-tight">{{ $description }}</p>
            @endif
        </div>
    @endif
</div>
