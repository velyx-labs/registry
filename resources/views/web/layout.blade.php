<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Velyx Registry') | Velyx Component Registry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @if($requires_alpine ?? false)
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
    <style>
        @vite('resources/css/app.css')
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl font-bold text-gray-900">Velyx</h1>
                    <span class="text-sm text-gray-500">Component Registry</span>
                </div>
                <nav class="flex space-x-6">
                    <a href="{{ route('components.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Components
                    </a>
                    <a href="/api/v1/components" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        API
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center text-sm text-gray-500">
                Velyx Registry v1.0 • Made with ❤️ for Laravel developers
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>