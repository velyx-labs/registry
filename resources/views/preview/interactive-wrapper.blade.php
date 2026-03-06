@props([
    'component',
    'props' => [],
    'variants' => [],
])

@php
    $componentKebab = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $component));
    $alpineData = match($component) {
        'Modal' => 'modalPreview',
        'Drawer' => 'drawerPreview',
        'Alert' => 'alertPreview',
        'Dropdown' => 'dropdownPreview',
        'Tooltip' => 'tooltipPreview',
        'Popover' => 'popoverPreview',
        'Dialog' => 'dialogPreview',
        default => 'interactivePreview',
    };
@endphp

<div x-data="{{ $alpineData }}()" x-init="initInteractive()">
    {{-- Trigger buttons area --}}
    <div class="preview-with-trigger">
        @if($component === 'Modal')
            <button @click="open = true" class="preview-button preview-button-primary">
                Open Modal
            </button>
        @elseif($component === 'Drawer')
            <button @click="open = true; position = 'right'" class="preview-button preview-button-primary">
                Open Right Drawer
            </button>
            <button @click="open = true; position = 'left'" class="preview-button preview-button-secondary">
                Open Left Drawer
            </button>
        @elseif($component === 'Alert')
            <button @click="show('info')" class="preview-button preview-button-primary">
                Show Info Alert
            </button>
            <button @click="show('success')" class="preview-button preview-button-primary" style="background: hsl(142 76% 36%);">
                Show Success
            </button>
            <button @click="show('warning')" class="preview-button preview-button-primary" style="background: hsl(43 96% 56%);">
                Show Warning
            </button>
            <button @click="show('error')" class="preview-button preview-button-primary" style="background: hsl(0 84% 60%);">
                Show Error
            </button>
        @endif
    </div>

    {{-- Render the actual component --}}
    @php
        // Generate appropriate slot content for interactive components
        $slotContent = match($component) {
            'Modal' => 'This is the modal content. You can put any content here.',
            'Drawer' => 'This is the drawer content.',
            'Alert' => 'This is an alert message with important information.',
            'Dropdown' => 'Dropdown menu item',
            'Tooltip' => 'Hover me',
            'Popover' => 'Popover content',
            'Dialog' => 'Are you sure you want to continue?',
            default => 'Content',
        };
    @endphp

    @if(file_exists(resource_path("views/components/ui/{$componentKebab}/index.blade.php")))
        @foreach($props as $key => $value)
            @php($attributes = $attributes->merge([$key => $value]))
        @endforeach

        @component("components.ui.{$componentKebab}.index")
            {{ $slotContent }}
        @endcomponent
    @elseif(file_exists(resource_path("views/components/ui/{$componentKebab}.blade.php")))
        @foreach($props as $key => $value)
            @php($attributes = $attributes->merge([$key => $value]))
        @endforeach

        @component("components.ui.{$componentKebab}")
            {{ $slotContent }}
        @endcomponent
    @endif
</div>

@push('previewScripts')
<script>
    function modalPreview() {
        return {
            open: false,
            initInteractive() {
                // Auto-open after short delay for preview
                setTimeout(() => { this.open = true }, 300);
            }
        }
    }

    function drawerPreview() {
        return {
            open: false,
            position: 'right',
            initInteractive() {
                setTimeout(() => { this.open = true }, 300);
            }
        }
    }

    function alertPreview() {
        return {
            visible: false,
            variant: 'info',
            initInteractive() {
                setTimeout(() => { this.show('info') }, 300);
            },
            show(variant) {
                this.variant = variant;
                this.visible = true;
            }
        }
    }

    function dropdownPreview() {
        return {
            open: false,
            initInteractive() {
                setTimeout(() => { this.open = true }, 300);
            }
        }
    }

    function tooltipPreview() {
        return {
            visible: false,
            initInteractive() {}
        }
    }

    function popoverPreview() {
        return {
            open: false,
            initInteractive() {
                setTimeout(() => { this.open = true }, 300);
            }
        }
    }

    function dialogPreview() {
        return {
            open: false,
            initInteractive() {
                setTimeout(() => { this.open = true }, 300);
            }
        }
    }

    function interactivePreview() {
        return {
            open: false,
            initInteractive() {}
        }
    }
</script>
@endpush
