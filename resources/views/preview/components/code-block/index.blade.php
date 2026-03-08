@props([
    'props' => [],
])

@php
    $language = (string) ($props['language'] ?? 'tsx');
    $filename = (string) ($props['filename'] ?? 'components/ui/card.tsx');
    $showLineNumbers = filter_var($props['showLineNumbers'] ?? true, FILTER_VALIDATE_BOOLEAN);

    $defaultCode = <<<'CODE'
import * as React from "react"

import { cn } from "@/lib/utils"

function Card({
  className,
  size = "default",
  ...props
}: React.ComponentProps<"div"> & { size?: "default" | "sm" }) {
  return (
    <div
      data-slot="card"
      className={cn("bg-card text-card-foreground rounded-xl border shadow-sm", className)}
      {...props}
    />
  )
}
CODE;

    $code = (string) ($props['code'] ?? $defaultCode);
@endphp

<div class="preview relative flex min-h-[340px] w-full items-start justify-center p-6">
    <x-ui.code-block
        class="w-full max-w-3xl"
        :code="$code"
        :language="$language"
        :filename="$filename"
        :show-line-numbers="$showLineNumbers"
    />
</div>
