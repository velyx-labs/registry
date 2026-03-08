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
<script>
      window.addEventListener('message', (event) => {
          // Allow messages from configured origins
          const allowedOrigins = [
              window.location.origin,
              {{ Illuminate\Support\Js::from(env('PREVIEW_ALLOWED_ORIGINS', [])) }}
          ].flat();

          if (!allowedOrigins.includes(event.origin)) return;

          if (event.data?.type === 'darkMode') {
              const isDark = event.data.value;
              document.documentElement.classList.toggle('dark', isDark);
          }
      });
  </script>
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
            @include($previewView, [
                'component' => $component,
                'props' => $props,
                'variants' => $variants ?? [],
                'currentVariant' => $currentVariant ?? 'default',
                'isInteractive' => $isInteractive ?? false,
            ])
        </div>
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
    </script>

    @stack('previewScripts')
    @livewireScripts
</body>
</html>
