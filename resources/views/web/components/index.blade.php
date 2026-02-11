@extends('web.layout')

@section('title', 'Components')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Component Registry</h1>
        <p class="text-gray-600">Browse and preview all available components</p>
    </div>

    <!-- Stats -->
    @if($total > 0)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="text-2xl font-bold text-blue-900">{{ $total }}</div>
                    <div class="text-sm text-blue-600">Total Components</div>
                </div>
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="text-2xl font-bold text-green-900">
                        {{ $components->where('requires_alpine', true)->count() }}
                    </div>
                    <div class="text-sm text-green-600">With Alpine.js</div>
                </div>
                <div class="bg-purple-50 rounded-lg p-4">
                    <div class="text-2xl font-bold text-purple-900">
                        {{ $components->pluck('all_versions')->flatten()->unique()->count() }}
                    </div>
                    <div class="text-sm text-purple-600">Total Versions</div>
                </div>
            </div>
        </div>
    @endif

    <!-- Components Grid -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Available Components</h2>
        </div>
        
        @if($components->isEmpty())
            <div class="text-center py-12">
                <div class="text-gray-400 text-lg">No components found</div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @foreach($components as $component)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <!-- Component Header -->
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-mono font-semibold text-gray-900">
                                {{ $component['name'] }}
                            </h3>
                            <div class="flex items-center space-x-2">
                                @if($component['requires_alpine'])
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Alpine</span>
                                @endif
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                    v{{ $component['version'] }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Component Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $component['description'] }}
                        </p>
                        
                        <!-- Component Info -->
                        <div class="space-y-2 text-sm">
                            @if(!empty($component['requires']))
                                <div class="flex items-center space-x-2">
                                    <span class="text-gray-500">Requires:</span>
                                    <span class="text-gray-700 font-mono text-xs">
                                        {{ implode(', ', array_slice($component['requires'], 0, 2)) }}
                                        @if(count($component['requires']) > 2)
                                            +{{ count($component['requires']) - 2 }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                            
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-500">Versions:</span>
                                <span class="text-gray-700">{{ count($component['all_versions']) }}</span>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-500">Laravel:</span>
                                <span class="text-gray-700 font-mono text-xs">{{ $component['laravel'] }}</span>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex space-x-2">
                                <a href="{{ route('components.show', $component['name']) }}" 
                                   class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                    Preview
                                </a>
                                <a href="{{ route('components.render', ['name' => $component['name'], 'version' => $component['version']]) }}" 
                                   class="flex-1 text-center bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                    Render
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection