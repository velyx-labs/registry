@props([
    'props' => [],
])

@php
    $language = (string) ($props['language'] ?? 'php');
    $filename = (string) ($props['filename'] ?? 'Example.php');
    $showLineNumbers = filter_var($props['showLineNumbers'] ?? true, FILTER_VALIDATE_BOOLEAN);

    $defaultCode = <<<'CODE'
<?php

declare(strict_types=1);

use App\Models\User;

$user = User::query()
    ->where('email', 'jane@example.com')
    ->first();

if ($user === null) {
    throw new RuntimeException('User not found.');
}

return $user->only(['id', 'name', 'email']);
CODE;

    $code = (string) ($props['code'] ?? $defaultCode);
@endphp

<div class="preview relative flex min-h-[360px] w-full items-start justify-center p-6">
    <x-ui.code-snippet
        class="w-full max-w-3xl"
        :code="$code"
        :language="$language"
        :filename="$filename"
        :show-line-numbers="$showLineNumbers"
    />
</div>
