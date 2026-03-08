@props([
    'code' => '',
    'language' => 'plaintext',
    'filename' => 'components/ui/card.tsx',
    'showLineNumbers' => true,
    'maxHeight' => '420px',
    'copyable' => true,
])

@php
    $lineCount = max(1, substr_count($code, "\n") + 1);
    $lineNumbers = range(1, $lineCount);
@endphp

<div
    x-data="codeBlock({
        code: {{ Js::from($code) }},
        language: {{ Js::from($language) }},
        copyable: {{ $copyable ? 'true' : 'false' }}
    })"
    {{ $attributes->merge(['class' => 'code-block overflow-hidden rounded-xl border bg-card text-card-foreground']) }}
>
    <div class="border-b bg-muted/50 px-4 py-2">
        <div class="flex items-center justify-between gap-3">
            <p class="truncate text-sm font-medium">{{ $filename }}</p>

            @if($copyable)
                <button
                    @click="copyCode"
                    class="text-muted-foreground hover:text-foreground hover:bg-muted/70 focus-visible:ring-ring inline-flex items-center gap-1 rounded-md px-2 py-1 text-xs transition-colors focus-visible:ring-2 focus-visible:outline-none"
                    :class="{ 'text-emerald-500': copied }"
                    type="button"
                >
                    <span x-text="copied ? 'Copied' : 'Copy'"></span>
                </button>
            @endif
        </div>
    </div>

    <div class="relative overflow-hidden" style="max-height: {{ $maxHeight }}">
        <div class="grid min-h-full grid-cols-[auto_1fr]">
            @if($showLineNumbers)
                <div class="text-muted-foreground/70 border-r bg-muted/30 px-3 py-4 text-right">
                    @foreach($lineNumbers as $line)
                        <div class="font-mono text-xs leading-6">{{ $line }}</div>
                    @endforeach
                </div>
            @endif

            <pre class="overflow-x-auto px-4 py-4"><code
                x-ref="codeContent"
                x-html="highlightedCode"
                class="language-{{ $language }} block font-mono text-[13px] leading-6"
            ></code></pre>
        </div>
    </div>
</div>
