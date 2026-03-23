@props([
    'steps' => [],
    'currentStep' => 1,
    'variant' => 'horizontal', // horizontal, vertical
    'size' => 'md', // sm, md, lg
    'showNumbers' => true,
    'clickable' => false,
])

@php
    $sizeClasses = match($size) {
        'sm' => [
            'indicator' => 'size-6 sm:size-8 text-xs',
            'label' => 'text-xs',
            'description' => 'text-[10px]',
            'connector' => 'h-0.5',
            'connectorVertical' => 'w-0.5 min-h-[40px]',
        ],
        'lg' => [
            'indicator' => 'size-10 sm:size-12 text-base',
            'label' => 'text-base',
            'description' => 'text-sm',
            'connector' => 'h-1',
            'connectorVertical' => 'w-1 min-h-[60px]',
        ],
        default => [
            'indicator' => 'size-8 sm:size-10 text-sm',
            'label' => 'text-sm',
            'description' => 'text-xs',
            'connector' => 'h-0.5',
            'connectorVertical' => 'w-0.5 min-h-[50px]',
        ],
    };

    $wireModel = $attributes->wire('model')->value();
@endphp

<div
    x-data="stepper({
        currentStep: {{ $currentStep }},
        totalSteps: {{ count($steps) }},
        clickable: @json((bool)$clickable),
        wireModel: '{{ $wireModel }}'
    })"
    {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => $variant === 'vertical' ? 'flex flex-col' : '']) }}
>
    {{-- Steps Indicator --}}
    <div class="{{ $variant === 'vertical' ? 'flex flex-col' : 'flex items-start justify-between' }}">
        @foreach($steps as $index => $step)
            @php
                $stepNumber = $index + 1;
                $isArray = is_array($step);
                $label = $isArray ? ($step['label'] ?? "Step {$stepNumber}") : $step;
                $description = $isArray ? ($step['description'] ?? null) : null;
                $icon = $isArray ? ($step['icon'] ?? null) : null;
            @endphp

            @if($variant === 'vertical')
                {{-- Vertical Step Layout --}}
                <div class="flex items-start pb-8">
                    {{-- Left: Indicator + Connector --}}
                    <div class="flex flex-col items-center">
                        <button
                            type="button"
                            @click="goToStep({{ $stepNumber }})"
                            :class="{
                                'bg-primary text-primary-foreground ring-2 ring-primary ring-offset-2 ring-offset-background': currentStep === {{ $stepNumber }},
                                'bg-primary text-primary-foreground': currentStep > {{ $stepNumber }},
                                'bg-muted text-muted-foreground': currentStep < {{ $stepNumber }},
                                'cursor-pointer hover:ring-2 hover:ring-primary/50': clickable && {{ $stepNumber }} <= currentStep,
                                'cursor-default': !clickable || {{ $stepNumber }} > currentStep
                            }"
                            class="{{ $sizeClasses['indicator'] }} rounded-full flex items-center justify-center font-medium transition-all duration-300 flex-shrink-0"
                            :disabled="!clickable || {{ $stepNumber }} > currentStep"
                        >
                            <template x-if="currentStep > {{ $stepNumber }}">
                                <x-lucide-check class="size-3 sm:size-4" />
                            </template>
                            <template x-if="currentStep <= {{ $stepNumber }}">
                                @if($icon)
                                    <x-dynamic-component :component="'lucide-' . $icon" class="size-3 sm:size-4" />
                                @elseif($showNumbers)
                                    <span>{{ $stepNumber }}</span>
                                @else
                                    <span class="size-2 rounded-full bg-current"></span>
                                @endif
                            </template>
                        </button>

                        {{-- Vertical Connector --}}
                        @if($stepNumber < count($steps))
                            <div class="{{ $sizeClasses['connectorVertical'] }} rounded-full overflow-hidden bg-muted mt-2">
                                <div
                                    class="w-full bg-primary transition-all duration-500"
                                    :style="`height: ${currentStep > {{ $stepNumber }} ? '100%' : '0%'}`"
                                ></div>
                            </div>
                        @endif
                    </div>

                    {{-- Right: Content --}}
                    <div class="ml-3 sm:ml-4 flex-1 -mt-1">
                        <p
                            class="{{ $sizeClasses['label'] }} font-medium transition-colors"
                            :class="currentStep >= {{ $stepNumber }} ? 'text-foreground' : 'text-muted-foreground'"
                        >
                            {{ $label }}
                        </p>
                        @if($description)
                            <p class="{{ $sizeClasses['description'] }} text-muted-foreground mt-1">
                                {{ $description }}
                            </p>
                        @endif
                    </div>
                </div>
            @else
                {{-- Horizontal Step Layout --}}
                <div class="flex flex-col items-center flex-1">
                    <div class="flex items-center w-full">
                        {{-- Step Indicator --}}
                        <button
                            type="button"
                            @click="goToStep({{ $stepNumber }})"
                            :class="{
                                'bg-primary text-primary-foreground ring-2 ring-primary ring-offset-2 ring-offset-background': currentStep === {{ $stepNumber }},
                                'bg-primary text-primary-foreground': currentStep > {{ $stepNumber }},
                                'bg-muted text-muted-foreground': currentStep < {{ $stepNumber }},
                                'cursor-pointer hover:ring-2 hover:ring-primary/50': clickable && {{ $stepNumber }} <= currentStep,
                                'cursor-default': !clickable || {{ $stepNumber }} > currentStep
                            }"
                            class="{{ $sizeClasses['indicator'] }} rounded-full flex items-center justify-center font-medium transition-all duration-300 flex-shrink-0"
                            :disabled="!clickable || {{ $stepNumber }} > currentStep"
                        >
                            <template x-if="currentStep > {{ $stepNumber }}">
                                <x-lucide-check class="size-3 sm:size-4" />
                            </template>
                            <template x-if="currentStep <= {{ $stepNumber }}">
                                @if($icon)
                                    <x-dynamic-component :component="'lucide-' . $icon" class="size-3 sm:size-4" />
                                @elseif($showNumbers)
                                    <span>{{ $stepNumber }}</span>
                                @else
                                    <span class="size-2 rounded-full bg-current"></span>
                                @endif
                            </template>
                        </button>

                        {{-- Horizontal Connector --}}
                        @if($stepNumber < count($steps))
                            <div class="flex-1 mx-2 sm:mx-4 {{ $sizeClasses['connector'] }} rounded-full overflow-hidden bg-muted">
                                <div
                                    class="h-full bg-primary transition-all duration-500"
                                    :style="`width: ${currentStep > {{ $stepNumber }} ? '100%' : '0%'}`"
                                ></div>
                            </div>
                        @endif
                    </div>

                    {{-- Step Content (Horizontal) --}}
                    <div class="mt-2 text-center max-w-[100px] sm:max-w-[120px]">
                        <p
                            class="{{ $sizeClasses['label'] }} font-medium transition-colors truncate"
                            :class="currentStep >= {{ $stepNumber }} ? 'text-foreground' : 'text-muted-foreground'"
                        >
                            {{ $label }}
                        </p>
                        @if($description)
                            <p class="{{ $sizeClasses['description'] }} text-muted-foreground mt-0.5 line-clamp-2 hidden sm:block">
                                {{ $description }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Step Content Slot --}}
    @if($slot->isNotEmpty())
        <div class="mt-4 sm:mt-6">
            {{ $slot }}
        </div>
    @endif
</div>
