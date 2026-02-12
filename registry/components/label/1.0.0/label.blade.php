@props([
    'for' => null,
    'required' => false,
    'description' => null,
])

@php
    $baseClasses = 'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70';
    
    $descriptionId = $description ? ($for ? $for . '-description' : null) : null;
@endphp

@if ($for)
    <label 
        for="{{ $for }}" 
        {{ $attributes->class($baseClasses) }}
        @if ($required) required @endif
    >
        {{ $slot }}
    </label>
    @if ($description && $descriptionId)
        <p id="{{ $descriptionId }}" class="text-sm text-muted-foreground">
            {{ $description }}
        </p>
    @endif
@else
    <span {{ $attributes->class($baseClasses) }}>
        {{ $slot }}
    </span>
    @if ($description && $descriptionId)
        <p id="{{ $descriptionId }}" class="text-sm text-muted-foreground">
            {{ $description }}
        </p>
    @endif
@endif