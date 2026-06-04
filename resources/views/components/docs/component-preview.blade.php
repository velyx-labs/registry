@props([
    'name',
    'variant' => null,
])

@php
    $sourceUrl = route('previews.source', array_filter(['component' => $name, 'variant' => $variant]));

    $previewView = view()->exists("preview.components.{$name}.index")
        ? "preview.components.{$name}.index"
        : (view()->exists("preview.components.{$name}") ? "preview.components.{$name}" : null);
@endphp

<div
    class="my-6 rounded-lg border bg-card"
    x-data="{
        mode: 'preview',
        source: '',
        sourcePath: '',
        sourceLoading: false,
        sourceError: '',
        async showCode() {
            this.mode = 'code';

            if (this.source || this.sourceLoading) return;

            this.sourceLoading = true;
            this.sourceError = '';

            try {
                const response = await fetch('{{ $sourceUrl }}', {
                    headers: { Accept: 'application/json' },
                });
                const json = await response.json();

                if (!response.ok) {
                    throw new Error(json.error || 'Preview source not found');
                }

                this.source = json.data.source;
                this.sourcePath = json.data.path;
                this.$nextTick(() => {
                    if (window.Prism) window.Prism.highlightAllUnder(this.$root);
                });
            } catch (error) {
                this.sourceError = error.message || 'Unable to load preview source';
            } finally {
                this.sourceLoading = false;
            }
        },
    }"
>
    {{-- Toolbar --}}
    <div class="flex items-center justify-between rounded-t-lg border-b bg-muted/30 px-4 py-2">
        <div class="flex items-center gap-2">
            <x-ui.badge variant="secondary">{{ $name }}</x-ui.badge>
            @if($variant)
                <span class="text-xs text-muted-foreground">{{ $variant }}</span>
            @endif
        </div>
        <div class="flex items-center gap-1">
            <x-ui.button type="button" variant="link" size="sm" x-show="mode === 'code'" x-cloak x-on:click="mode = 'preview'">Preview</x-ui.button>
            <x-ui.button type="button" variant="link" size="sm" x-show="mode === 'preview'" x-on:click="showCode()">Code</x-ui.button>
        </div>
    </div>

    {{-- Inline preview --}}
    <div x-show="mode === 'preview'" class="bg-background relative z-[100]">
        @if($previewView)
            @include($previewView, ['props' => []])
        @else
            <div class="flex h-[220px] items-center justify-center text-sm text-muted-foreground">
                No preview available.
            </div>
        @endif
    </div>

    {{-- Source code --}}
    <div x-show="mode === 'code'" x-cloak class="overflow-hidden rounded-b-lg border-t bg-muted/20">
        
        <div x-show="sourceLoading" class="p-4 text-sm text-muted-foreground">Loading source...</div>
        <div x-show="sourceError" class="p-4 text-sm text-destructive" x-text="sourceError"></div>
        <pre x-show="source && !sourceLoading" 
            class="max-h-[420px] overflow-auto  bg-transparent! border-none!"
            x-ref="codeBlock">
            <code class="language-php" x-text="source"></code>
        </pre>
    </div>
</div>
