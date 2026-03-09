@props([
    'component',
    'props' => [],
])

@php
    // Convert component name to kebab-case for the view path
    $componentView = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $component));

    // Generate default slot content based on component type
    $defaultSlot = match($componentView) {
        'button' => ($props['label'] ?? 'Button'),
        'alert' => ($props['title'] ?? 'Alert message') . '. ' . ($props['description'] ?? 'This is an alert message.'),
        'modal' => 'Modal content goes here.',
        'drawer' => 'Drawer content goes here.',
        'card' => 'Card content goes here.',
        'badge' => ($props['label'] ?? 'Badge'),
        'input' => 'Input field',
        'textarea' => 'Textarea content',
        'dropdown-menu' => 'Dropdown content',
        default => ucfirst($componentView) . ' content',
    };
@endphp

@php($componentProps = array_merge($props, ['slot' => $defaultSlot]))

@if(file_exists(resource_path("views/components/ui/{$componentView}/index.blade.php")))
    {{-- Multi-file component - render with slot --}}
    @foreach($props as $key => $value)
        @php($attributes = $attributes->merge([$key => $value]))
    @endforeach

    @component("components.ui.{$componentView}.index")
        {{ $defaultSlot }}
    @endcomponent
@elseif(file_exists(resource_path("views/components/ui/{$componentView}.blade.php")))
    {{-- Single-file component - render with slot --}}
    @foreach($props as $key => $value)
        @php($attributes = $attributes->merge([$key => $value]))
    @endforeach

    @component("components.ui.{$componentView}")
        {{ $defaultSlot }}
    @endcomponent
@else
    {{-- Fallback: try to render as a component --}}
    @foreach($props as $key => $value)
        @php($attributes = $attributes->merge([$key => $value]))
    @endforeach

    <div class="component-fallback">
        <x-ui.{{ $componentView }} {{ $attributes }}>
            {{ $defaultSlot }}
        </x-ui.{{ $componentView }}>
    </div>
@endif
