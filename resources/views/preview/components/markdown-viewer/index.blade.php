@props([
    'props' => [],
])

@php
    $defaultMarkdown = <<<'MD'
# Markdown Viewer

This is a **simple markdown viewer** component.

## Features

- Renders markdown headings and text
- Supports lists and inline formatting
- Displays code blocks cleanly

```php
$user = User::query()->first();
```

> Keep it minimal and readable.
MD;

    $content = (string) ($props['content'] ?? $defaultMarkdown);
@endphp

<div class="preview relative flex min-h-[340px] w-full items-start justify-center p-6">
    <x-ui.markdown-viewer class="w-full max-w-3xl" :content="$content" />
</div>
