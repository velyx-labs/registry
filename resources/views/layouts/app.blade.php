<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="bg-background text-foreground min-h-screen">
    <div class="relative flex min-h-screen flex-col">
        <!-- Navigation -->
        @if (isset($navigation) && $navigation !== false)
            <nav
                class="sticky top-0 z-50 w-full border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="flex h-14 items-center justify-between">
                        <!-- Logo -->
                        <div class="flex items-center space-x-4">
                            <a href="/" class="flex items-center space-x-2">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded bg-primary text-primary-foreground">
                                    <span class="text-sm font-bold">V</span>
                                </div>
                                <span class="font-semibold text-foreground">Velyx</span>
                            </a>
                        </div>

                        <!-- Desktop Navigation -->
                        @auth
                            <div class="hidden md:flex items-center space-x-6">
                                <a href="{{ route('dashboard') }}"
                                    class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">
                                    Dashboard
                                </a>
                                <a href="/components"
                                    class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">
                                    Components
                                </a>
                                <a href="/docs"
                                    class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">
                                    Documentation
                                </a>
                            </div>
                        @else
                            <div class="hidden md:flex items-center space-x-6">
                                <a href="/docs"
                                    class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">
                                    Documentation
                                </a>
                                <a href="/components"
                                    class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">
                                    Components
                                </a>
                            </div>
                        @endauth

                        <!-- Right side actions -->
                        <div class="flex items-center space-x-4">
                            <!-- Theme Toggle -->
                            <flux:button variant="ghost" size="sm"
                                x-data="{ dark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
                                :class="dark ? 'text-yellow-500' : 'text-gray-500'"
                                @click="dark = !dark; localStorage.setItem('theme', dark ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', dark)">
                                <x-lucide-sun class="w-4 h-4" x-show="!dark" />
                                <x-lucide-moon class="w-4 h-4" x-show="dark" />
                            </flux:button>

                            <!-- Auth Links -->
                            @auth
                                <flux:dropdown placement="bottom-end">
                                    <flux:button variant="ghost" size="sm">
                                        <flux:avatar size="sm" />
                                    </flux:button>

                                </flux:dropdown>
                            @else
                                <flux:button variant="ghost" size="sm" href="{{ route('login') }}">
                                    Log in
                                </flux:button>
                                @if (Route::has('register'))
                                    <flux:button variant="primary" size="sm" href="{{ route('register') }}">
                                        Sign up
                                    </flux:button>
                                @endif
                            @endauth
                        </div>

                        <!-- Mobile Menu Button -->
                        <flux:button variant="ghost" size="sm" class="md:hidden" x-data="{ open: false }"
                            @click="open = !open">
                            <x-lucide-menu class="w-5 h-5" />
                        </flux:button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div x-data="{ open: false }" x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="border-t border-border md:hidden" x-cloak>
                    <div class="px-6 py-3 space-y-3">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="block px-3 py-2 rounded-md text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted">
                                Dashboard
                            </a>
                        @endauth
                        <a href="/docs"
                            class="block px-3 py-2 rounded-md text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted">
                            Documentation
                        </a>
                        <a href="/components"
                            class="block px-3 py-2 rounded-md text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted">
                            Components
                        </a>
                        @guest
                            <a href="{{ route('login') }}"
                                class="block px-3 py-2 rounded-md text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="block px-3 py-2 rounded-md text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted">
                                    Sign up
                                </a>
                            @endif
                        @endguest
                    </div>
                </div>
            </nav>
        @endif

        <!-- Page Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        @if (isset($footer) && $footer !== false)
            <footer class="border-t border-border bg-background">
                <div class="max-w-7xl mx-auto px-6 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Brand -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded bg-primary text-primary-foreground">
                                    <span class="text-sm font-bold">V</span>
                                </div>
                                <span class="font-semibold text-foreground">Velyx</span>
                            </div>
                            <p class="text-sm text-muted-foreground">
                                CLI-driven component system for Laravel.
                            </p>
                        </div>

                        <!-- Product -->
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-foreground">Product</h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="/features"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Features
                                    </a>
                                </li>
                                <li>
                                    <a href="/components"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Components
                                    </a>
                                </li>
                                <li>
                                    <a href="/examples"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Examples
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Resources -->
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-foreground">Resources</h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="/docs"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Documentation
                                    </a>
                                </li>
                                <li>
                                    <a href="/blog"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a href="/support"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Support
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Legal -->
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-foreground">Legal</h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="/privacy"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Privacy
                                    </a>
                                </li>
                                <li>
                                    <a href="/terms"
                                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                                        Terms
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-border">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <p class="text-sm text-muted-foreground">
                                © {{ date('Y') }} Velyx. All rights reserved.
                            </p>
                            <div class="flex space-x-6 mt-4 md:mt-0">
                                <a href="https://github.com/velyx/velyx"
                                    class="text-muted-foreground hover:text-foreground transition-colors">
                                    <x-lucide-github class="w-5 h-5" />
                                </a>
                                <a href="https://twitter.com/velyx"
                                    class="text-muted-foreground hover:text-foreground transition-colors">
                                    <x-lucide-twitter class="w-5 h-5" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        @endif
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Initialize theme -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>

</html>