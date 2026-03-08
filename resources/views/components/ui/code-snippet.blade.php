@props([
    'code' => '',
    'language' => 'plaintext',
    'filename' => null,
    'showLineNumbers' => true,
    'maxHeight' => '400px',
    'copyable' => true,
])

@php
    $lineCount = max(1, substr_count($code, "\n") + 1);
    $lineNumbers = range(1, $lineCount);

    $languageConfig = [
        'php' => ['icon' => 'P', 'badge' => 'text-violet-500 bg-violet-500/15'],
        'javascript' => ['icon' => 'JS', 'badge' => 'text-amber-500 bg-amber-500/15'],
        'typescript' => ['icon' => 'TS', 'badge' => 'text-blue-500 bg-blue-500/15'],
        'python' => ['icon' => 'PY', 'badge' => 'text-emerald-500 bg-emerald-500/15'],
        'bash' => ['icon' => '$', 'badge' => 'text-green-500 bg-green-500/15'],
        'html' => ['icon' => '<>', 'badge' => 'text-orange-500 bg-orange-500/15'],
        'css' => ['icon' => '#', 'badge' => 'text-sky-500 bg-sky-500/15'],
        'json' => ['icon' => '{}', 'badge' => 'text-yellow-500 bg-yellow-500/15'],
        'sql' => ['icon' => 'DB', 'badge' => 'text-cyan-500 bg-cyan-500/15'],
        'blade' => ['icon' => 'B', 'badge' => 'text-red-500 bg-red-500/15'],
    ];

    $langConfig = $languageConfig[$language] ?? ['icon' => '?', 'badge' => 'text-muted-foreground bg-muted'];
@endphp

<div
    x-data="codeSnippet({
        code: {{ Js::from($code) }},
        language: {{ Js::from($language) }},
        copyable: {{ $copyable ? 'true' : 'false' }}
    })"
    {{ $attributes->merge(['class' => 'code-snippet bg-card text-card-foreground overflow-hidden rounded-lg border']) }}
>
    <div class="bg-muted/50 border-b px-4 py-2">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1.5">
                    <span class="bg-muted-foreground/40 size-2 rounded-full"></span>
                    <span class="bg-muted-foreground/40 size-2 rounded-full"></span>
                    <span class="bg-muted-foreground/40 size-2 rounded-full"></span>
                </div>

                <div class="flex items-center gap-2">
                    <span class="{{ $langConfig['badge'] }} rounded px-1.5 py-0.5 text-xs font-mono">
                        {{ $langConfig['icon'] }}
                    </span>
                    @if($filename)
                        <span class="text-sm font-mono text-current/80">{{ $filename }}</span>
                    @else
                        <span class="text-muted-foreground text-sm font-mono capitalize">{{ $language }}</span>
                    @endif
                </div>
            </div>

            @if($copyable)
                <button
                    @click="copyCode"
                    class="text-muted-foreground hover:text-foreground hover:bg-muted/70 focus-visible:ring-ring inline-flex items-center gap-1.5 rounded-md px-2.5 py-1 text-xs font-medium transition-colors focus-visible:ring-2 focus-visible:outline-none"
                    :class="{ 'text-emerald-500': copied }"
                >
                    <template x-if="!copied">
                        <span class="flex items-center gap-1.5">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <span>Copy</span>
                        </span>
                    </template>
                    <template x-if="copied">
                        <span class="flex items-center gap-1.5">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Copied!</span>
                        </span>
                    </template>
                </button>
            @endif
        </div>
    </div>

    <div class="relative overflow-hidden" style="max-height: {{ $maxHeight }}">
        <div class="flex items-stretch min-h-full">
            @if($showLineNumbers)
                <div class="text-muted-foreground/70 bg-muted/30 border-border/60 shrink-0 select-none border-r px-3 py-4 text-right">
                    @foreach($lineNumbers as $line)
                        <div class="font-mono text-xs leading-6">{{ $line }}</div>
                    @endforeach
                </div>
            @endif

            <pre class="flex-1 overflow-x-auto px-4 py-4"><code
                x-ref="codeContent"
                x-html="highlightedCode"
                class="language-{{ $language }} block text-sm leading-6"
            ></code></pre>
        </div>
    </div>

    <div class="text-muted-foreground bg-muted/40 border-t px-4 py-1.5 text-xs">
        <div class="flex items-center justify-between">
            <span>{{ $lineCount }} lines</span>
            <span class="font-mono">{{ strtoupper($language) }}</span>
        </div>
    </div>
</div>
