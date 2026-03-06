<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $component }} (Props)</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    {{-- Tailwind & app assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
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

        .props-preview-container {
            max-width: 100%;
            margin: 0 auto;
        }

        .props-info {
            background: hsl(var(--muted) / 0.5);
            border: 1px solid hsl(var(--border));
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .props-info h3 {
            margin: 0 0 0.5rem 0;
            font-size: 0.875rem;
            font-weight: 600;
            color: hsl(var(--foreground));
        }

        .props-info code {
            background: hsl(var(--background));
            padding: 0.125rem 0.25rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .component-display {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 300px;
            padding: 2rem;
            border: 1px dashed hsl(var(--border));
            border-radius: 0.5rem;
            background: hsl(var(--background) / 0.5);
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body>
    <div x-data="propsPreview()" x-init="init()" x-cloak>
        <div class="props-preview-container">
            {{-- Props info panel --}}
            <div class="props-info">
                <h3>Current Props</h3>
                <div class="mt-2 space-y-1">
                    @foreach($props as $key => $value)
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-xs">{{ $key }}:</span>
                            <code>{{ json_encode($value) }}</code>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Component display --}}
            <div class="component-display">
                @include('preview.static-wrapper', [
                    'component' => $component,
                    'props' => $props,
                ])
            </div>
        </div>
    </div>

    <script>
        function propsPreview() {
            return {
                props: @js($props),
                component: '{{ $component }}',

                init() {
                    this.$nextTick(() => {
                        window.parent.postMessage({
                            type: 'preview:ready',
                            component: this.component,
                            props: this.props,
                        }, '*');
                    });
                }
            }
        }
    </script>
</body>
</html>
