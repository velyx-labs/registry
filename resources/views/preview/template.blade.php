<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $component }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    {{-- Tailwind & app assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        /* Preview-specific styles */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: transparent;
        }

        .preview-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        /* For interactive components that need triggers */
        .preview-with-trigger {
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Preview controls panel */
        .preview-controls {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 9999;
        }

        .preview-controls-panel {
            background: hsl(var(--background));
            border: 1px solid hsl(var(--foreground));
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            padding: 0.75rem;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            max-width: 300px;
        }

        .preview-button {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .preview-button-primary {
            background: hsl(var(--primary));
            color: hsl(var(--primary-foreground));
        }

        .preview-button-primary:hover {
            opacity: 0.9;
        }

        .preview-button-secondary {
            background: hsl(var(--secondary));
            color: hsl(var(--secondary-foreground));
        }

        .preview-button-secondary:hover {
            opacity: 0.9;
        }

        /* Loading state */
        .preview-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }

        .preview-spinner {
            width: 2rem;
            height: 2rem;
            border: 2px solid hsl(var(--border));
            border-top-color: hsl(var(--primary));
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

    </style>
</head>
<body>
    <div class="preview-container" data-preview="{{ $component }}" data-variant="{{ $currentVariant ?? 'default' }}">
        {{-- Loading state --}}
        <div x-cloak x-data="{ loaded: true }" x-show="!loaded" class="preview-loading">
            <div class="preview-spinner"></div>
        </div>

        {{-- Component content --}}
        <div x-data="previewData()" x-init="initPreview()" x-show="loaded" x-cloak>
            {{-- Render the component --}}
            @if($isInteractive)
                @include('preview.interactive-wrapper', [
                    'component' => $component,
                    'props' => $props,
                    'variants' => $variants ?? [],
                ])
            @else
                @include('preview.static-wrapper', [
                    'component' => $component,
                    'props' => $props,
                ])
            @endif
        </div>

        {{-- Preview controls for interactive components --}}
        @if($isInteractive ?? false)
            @include('preview.controls.' . strtolower($component))
        @endif
    </div>

    {{-- Preview initialization script --}}
    <script>
        function previewData() {
            return {
                loaded: false,
                component: '{{ $component }}',
                props: @js($props),
                variant: '{{ $currentVariant ?? 'default' }}',

                initPreview() {
                    // Wait for Alpine to be ready
                    this.$nextTick(() => {
                        this.loaded = true;

                        // Emit ready event to parent iframe
                        window.parent.postMessage({
                            type: 'preview:ready',
                            component: this.component,
                            variant: this.variant,
                        }, '*');
                    });
                }
            }
        }

        // Listen for messages from parent
        window.addEventListener('message', (event) => {
            if (event.data.type === 'preview:updateProps') {
                // Update props dynamically
                console.log('Updating props:', event.data.props);
            }
        });
    </script>

    @stack('previewScripts')
    @livewireScripts
</body>
</html>
