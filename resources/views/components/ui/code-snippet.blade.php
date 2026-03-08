@props([
    'code' => '',
    'language' => 'plaintext',
    'filename' => 'components/ui/card.tsx',
    'showLineNumbers' => true,
    'maxHeight' => '420px',
    'copyable' => true,
])

<x-ui.code-block
    :code="$code"
    :language="$language"
    :filename="$filename"
    :show-line-numbers="$showLineNumbers"
    :max-height="$maxHeight"
    :copyable="$copyable"
    {{ $attributes }}
/>
