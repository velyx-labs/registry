<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Preview: {{ $component }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    {{-- Tailwind & app assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js with plugins --}}
    <script defer src="https://cdn.unpkg.com/@alpinejs/ui@3.13.0/dist/cdn.min.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.unpkg.com/@alpinejs/focus@3.13.0/dist/cdn.min.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.unpkg.com/alpinejs@3.13.0/dist/cdn.min.js" defer></script>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 2rem;
            min-height: 100vh;
            background: transparent;
            font-family: 'Geist', sans-serif;
        }

        .interactive-container {
            max-width: 100%;
            margin: 0 auto;
        }

        .interactive-triggers {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 2rem;
            background: hsl(var(--muted) / 0.3);
            border: 1px solid hsl(var(--border));
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

        .interactive-trigger {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            border: 1px solid hsl(var(--border));
            background: hsl(var(--background));
            color: hsl(var(--foreground));
            cursor: pointer;
            transition: all 0.2s;
        }

        .interactive-trigger:hover {
            background: hsl(var(--accent));
            color: hsl(var(--accent-foreground));
        }

        .component-stage {
            min-height: 400px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-controls {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 9999;
        }

        .preview-controls-panel {
            background: hsl(var(--background));
            border: 1px solid hsl(var(--border));
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            padding: 1rem;
        }

        .preview-controls-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: hsl(var(--muted-foreground));
            margin-bottom: 0.5rem;
        }

        .preview-controls-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body>
    <div class="interactive-container">
        {{-- Context info --}}
        <div class="mb-4 p-3 bg-muted/30 border rounded-lg">
            <p class="text-sm text-muted-foreground">
                <strong>Interactive Preview:</strong> {{ $context['alpineData'] ?? 'default' }}
            </p>
            @if(isset($context['requiresOverlay']) && $context['requiresOverlay'])
                <p class="text-xs text-muted-foreground mt-1">This component requires an overlay backdrop.</p>
            @endif
        </div>

        {{-- Interactive trigger buttons --}}
        @if(isset($context['testTriggers']) && !empty($context['testTriggers']))
            <div class="interactive-triggers">
                @foreach($context['testTriggers'] as $trigger)
                    <button class="interactive-trigger" @click="{{ $trigger['action'] }}">
                        {{ $trigger['label'] }}
                    </button>
                @endforeach
            </div>
        @endif

        {{-- Component stage --}}
        <div class="component-stage">
            @include('preview.interactive-wrapper', [
                'component' => $component,
                'props' => $props,
                'context' => $context,
            ])
        </div>

        {{-- Floating controls panel --}}
        <div class="preview-controls">
            <div class="preview-controls-panel">
                <div class="preview-controls-title">Preview Controls</div>
                <div class="preview-controls-buttons">
                    <button @click="window.location.reload()" class="interactive-trigger text-xs">
                        Reload
                    </button>
                    <button @click="$dispatch('preview-reset')" class="interactive-trigger text-xs">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    @stack('interactiveScripts')
</body>
</html>
