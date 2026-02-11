@extends('web.layout')

@section('title', $component_name . ' Preview')

@push('styles')
<style>
    .preview-container {
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
    }
    
    .preview-content {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        max-width: 100%;
    }
    
    .component-info {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Component Info Panel -->
    <div class="component-info">
        <div class="text-sm space-y-2">
            <div class="flex items-center space-x-2">
                <span class="font-semibold">{{ $component_name }}</span>
                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">v{{ $version }}</span>
            </div>
            @if($requires_alpine)
                <div class="flex items-center space-x-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    <span class="text-xs">Alpine.js</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Preview Container -->
    <div class="preview-container">
        <div class="preview-content">
            {!! $blade_content !!}
        </div>
    </div>

    <!-- Component Source -->
    @if($css_content || $js_content)
        <div class="bg-white rounded-lg shadow mt-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Component Source</h2>
            </div>
            
            @if($css_content)
                <div class="border-b border-gray-200">
                    <div class="px-6 py-3 bg-gray-50">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">CSS</h3>
                    </div>
                    <pre class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-sm"><code>{{ $css_content }}</code></pre>
                </div>
            @endif
            
            @if($js_content)
                <div>
                    <div class="px-6 py-3 bg-gray-50">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">JavaScript</h3>
                    </div>
                    <pre class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-sm"><code>{{ $js_content }}</code></pre>
                </div>
            @endif
        </div>
    @endif
</div>

@push('scripts')
@if($js_content)
    <script>
        {!! $js_content !!}
    </script>
@endif
@endpush