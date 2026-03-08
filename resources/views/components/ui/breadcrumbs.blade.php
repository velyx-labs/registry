@props([
    'items' => [],
    'separator' => '/',
    'homeIcon' => false,
])

@php
    $hasItems = count($items) > 0;
@endphp

@if($hasItems)
    <nav {{ $attributes->merge(['class' => 'flex']) }} aria-label="Breadcrumb">
        <ol class="inline-flex items-center gap-1 md:gap-2 text-sm text-muted-foreground">
            @foreach($items as $index => $item)
                @php
                    $isLast = $index === count($items) - 1;
                    $label = is_array($item) ? ($item['label'] ?? '') : $item;
                    $url = is_array($item) ? ($item['url'] ?? null) : null;
                @endphp

                <li class="inline-flex items-center gap-1 md:gap-2">
                    @if($index > 0)
                        <span class="text-muted-foreground/60" aria-hidden="true">{{ $separator }}</span>
                    @endif

                    @if($url && ! $isLast)
                        <a
                            href="{{ $url }}"
                            class="inline-flex items-center gap-1 font-medium text-muted-foreground transition-colors hover:text-foreground"
                        >
                            @if($index === 0 && $homeIcon)
                                <x-lucide-house class="size-3.5" />
                            @endif
                            {{ $label }}
                        </a>
                    @else
                        <span
                            class="inline-flex items-center gap-1 font-medium {{ $isLast ? 'text-foreground' : 'text-muted-foreground' }}"
                            @if($isLast) aria-current="page" @endif
                        >
                            @if($index === 0 && $homeIcon)
                                <x-lucide-house class="size-3.5" />
                            @endif
                            {{ $label }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
