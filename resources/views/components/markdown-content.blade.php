@props([
    'content',
    'copyable' => true,
])

<div {{ $attributes->merge(['class' => 'prose prose-zinc dark:prose-invert']) }} @if ($copyable) id="content" @endif>
    {!! replace_links(\App\Markdown\MarkdownHelper::parseLiquidTags(\GrahamCampbell\Markdown\Facades\Markdown::convert($content))) !!}
</div>
