@props([
    'error' => null,
])

@if($error)
    <p class="mt-1.5 text-sm text-destructive flex items-center gap-1">
        <x-dynamic-component component="lucide-alert-circle" class="h-4 w-4" />
        {{ $error }}
    </p>
@endif
