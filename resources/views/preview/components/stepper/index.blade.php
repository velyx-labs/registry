@props([
    'props' => [],
])

@php
    $variant = (string) ($props['variant'] ?? 'horizontal');
    $currentStep = (int) ($props['currentStep'] ?? 2);
    $steps = [
        ['label' => 'Account', 'description' => 'Create your workspace', 'icon' => 'user-round'],
        ['label' => 'Project', 'description' => 'Define structure', 'icon' => 'folder-kanban'],
        ['label' => 'Deploy', 'description' => 'Ship with confidence', 'icon' => 'rocket'],
    ];
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-4xl rounded-xl border border-border bg-card p-6">
        <x-ui.stepper :steps="$steps" :current-step="$currentStep" :variant="$variant">
            <div class="rounded-lg border border-dashed border-border bg-muted/20 p-4 text-sm text-muted-foreground">
                Current step content stays here while the indicator handles progress and navigation cues.
            </div>
        </x-ui.stepper>
    </div>
</div>
