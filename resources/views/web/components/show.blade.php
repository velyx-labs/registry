@extends('web.layout')

@section('title', $component['name'] . ' Component')

@section('content')
<div class="space-y-6">
    <!-- Component Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $component['name'] }}</h1>
                <p class="text-gray-600 text-lg">{{ $component['meta']['description'] }}</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-mono font-bold text-blue-600">v{{ $component['version'] }}</div>
                <div class="text-sm text-gray-500">Current Version</div>
            </div>
        </div>

        <!-- Component Meta -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Versions</h3>
                <div class="space-y-1">
                    @foreach($all_versions as $version)
                        <div class="flex items-center space-x-2">
                            <span class="font-mono text-sm {{ $version === $current_version ? 'text-blue-600 font-bold' : 'text-gray-600' }}">
                                v{{ $version }}
                            </span>
                            @if($version === $current_version)
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Current</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Dependencies</h3>
                <div class="space-y-2">
                    @if($component['meta']['requires_alpine'])
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            <span class="text-sm">Alpine.js Required</span>
                        </div>
                    @else
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                            <span class="text-sm text-gray-600">No Alpine.js</span>
                        </div>
                    @endif
                    
                    @if(!empty($component['meta']['requires']))
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            <span class="text-sm font-mono">{{ implode(', ', $component['meta']['requires']) }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Requirements</h3>
                <div class="space-y-1">
                    <div class="text-sm">
                        <span class="text-gray-600">Laravel:</span>
                        <span class="font-mono text-gray-900 ml-1">{{ $component['meta']['laravel'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Version Selector -->
    @if(count($all_versions) > 1)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Select Version</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($all_versions as $version)
                    <a href="{{ route('components.version', ['name' => $component['name'], 'version' => $version]) }}" 
                       class="px-4 py-2 rounded-md text-sm font-medium transition-colors
                              {{ $version === $current_version ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        v{{ $version }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Component Preview -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Component Preview</h2>
                <a href="{{ route('components.render', ['name' => $component['name'], 'version' => $component['version']]) }}" 
                   class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                    Open in new window →
                </a>
            </div>
        </div>
        
        <div class="p-6">
            @if(isset($component['files']['resources/views/components/ui/' . $component['name'] . '.blade.php']))
                <iframe src="{{ route('components.render', ['name' => $component['name'], 'version' => $component['version']]) }}" 
                        class="w-full h-96 border-0 rounded-lg"
                        loading="lazy">
                </iframe>
            @else
                <div class="text-center py-8 text-gray-500">
                    <div class="mb-4">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707H19a2 2 0 012 2v1a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="text-lg font-medium">Component template not found</div>
                    <div class="text-sm mt-2">This component might not have a Blade template file.</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Component Files -->
    @if(!empty($component['files']))
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Component Files</h2>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($component['files'] as $path => $content)
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-mono text-sm font-medium text-gray-900">{{ $path }}</span>
                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded">
                                {{ Str::upper(pathinfo($path, PATHINFO_EXTENSION)) }}
                            </span>
                        </div>
                        <pre class="bg-gray-900 text-gray-100 p-4 rounded-md overflow-x-auto text-sm"><code>{{ $content }}</code></pre>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection