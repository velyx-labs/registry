@extends('layouts.app')

@section('title', 'Component Previews')

@section('content')
<div class="min-h-screen bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-foreground">Component Preview Dashboard</h1>
            <p class="mt-2 text-muted-foreground">
                Live previews of all available components
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($components as $name => $data)
                <div class="bg-card border border-border rounded-lg p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-foreground mb-2">
                        {{ ucfirst($name) }}
                    </h3>

                    @if(isset($data['meta']['description']))
                        <p class="text-sm text-muted-foreground mb-4">
                            {{ $data['meta']['description'] }}
                        </p>
                    @endif

                    <div class="flex flex-col gap-2">
                        {{-- Basic Preview --}}
                        <a href="{{ $previewUrls[$name]['basic'] }}" target="_blank"
                           class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Preview
                        </a>

                        {{-- Props Preview --}}
                        <a href="{{ $previewUrls[$name]['props'] }}" target="_blank"
                           class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md bg-secondary text-secondary-foreground hover:bg-secondary/90">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            With Props
                        </a>

                        {{-- Interactive Preview --}}
                        @if(isset($previewUrls[$name]['interactive']))
                            <a href="{{ $previewUrls[$name]['interactive'] }}" target="_blank"
                               class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md border border-border hover:bg-accent">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Interactive
                            </a>
                        @endif
                    </div>

                    {{-- Categories --}}
                    @if(isset($data['meta']['categories']) && !empty($data['meta']['categories']))
                        <div class="mt-4 flex flex-wrap gap-1">
                            @foreach($data['meta']['categories'] as $category)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded bg-muted text-muted-foreground">
                                    {{ $category }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
