@props([
    'content' => '',
    'maxHeight' => '420px',
])

@php
    $markdown = trim((string) $content);
    $html = $markdown === ''
        ? ''
        : Illuminate\Support\Str::markdown($markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
@endphp

<div {{ $attributes->merge(['class' => 'markdown-viewer overflow-auto rounded-xl border bg-card p-4 text-card-foreground']) }} style="max-height: {{ $maxHeight }}">
    <article class="prose prose-sm max-w-none dark:prose-invert">
        {!! $html !!}
    </article>
</div>
