<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Velyx - Beautiful Design Systems for Laravel' }}">
    <meta name="keywords" content="UI components, Laravel, Livewire, Tailwind CSS, design system">

    <title>{{ $title ?? 'Documentation' }} - Velyx</title>

    @include('partials.head')
    @livewireStyles

    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }

        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: oklch(0.708 0 0);
            border-radius: 2px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: oklch(0.556 0 0);
        }

        /* Table of styles */
        .prose pre {
            background: oklch(0.97 0 0);
            border: 1px solid oklch(0.922 0 0);
        }

        .dark .prose pre {
            background: oklch(0.269 0 0);
            border: 1px solid oklch(0.325 0 0);
        }
    </style>
</head>
<body class="bg-background text-foreground antialiased">
    <div class="flex min-h-screen flex-col">
        <!-- Header -->
        <header class="sticky top-0 z-50 w-full border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
            <div class="container flex h-14 items-center px-4 md:px-6 lg:px-8">
                <div class="flex items-center gap-6">
                    <a href="/" class="flex items-center space-x-2">
                        <span class="text-lg font-bold">Velyx</span>
                    </a>

                    <nav class="hidden md:flex items-center gap-6 text-sm">
                        <a href="/docs"
                           class="{{ is_docs_page() ? 'text-foreground' : 'text-muted-foreground hover:text-foreground' }} transition-colors">
                            Docs
                        </a>
                        <a href="/docs/components/button"
                           class="{{ is_component_page() ? 'text-foreground' : 'text-muted-foreground hover:text-foreground' }} transition-colors">
                            Components
                        </a>
                        <a href="{{ config('velyx.github_url', 'https://github.com') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-muted-foreground hover:text-foreground transition-colors">
                            GitHub
                        </a>
                    </nav>
                </div>

                <div class="flex flex-1 items-center justify-end gap-4">
                    <!-- Dark mode toggle -->
                    <button
                        x-data="themeToggle"
                        @click="toggleTheme"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground h-9 w-9"
                        aria-label="Toggle theme"
                    >
                        <svg class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg class="h-5 w-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- Mobile menu button -->
                    <button
                        x-data="{ mobileMenuOpen: false }"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground h-9 w-9"
                        aria-label="Toggle menu"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <div class="container flex-1">
            <div class="flex-1 md:grid md:grid-cols-[220px_1fr] md:gap-6 lg:grid-cols-[240px_1fr] lg:gap-10">
                <!-- Mobile menu overlay -->
                <div
                    x-data="{ mobileMenuOpen: false }"
                    x-show="mobileMenuOpen"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 bg-background/80 backdrop-blur-sm md:hidden"
                    @click="mobileMenuOpen = false"
                ></div>

                <!-- Sidebar -->
                <aside
                    x-data="{ mobileMenuOpen: false }"
                    :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
                    class="fixed top-14 z-30 -translate-x-full border-r border-border bg-background p-4 shadow-lg transition-transform md:sticky md:translate-x-0 md:shadow-none md:border-r-0 md:bg-transparent md:p-0 overflow-y-auto sidebar-scroll"
                    style="height: calc(100vh - 3.5rem); width: 240px;"
                >
                    <div class="py-6">
                        <!-- Getting Started -->
                        @php
                            $gettingStarted = get_getting_started_pages();
                            $gettingStartedTitle = get_getting_started_title();
                        @endphp

                        @if(!empty($gettingStarted))
                            <div class="mb-6">
                                <h3 class="mb-2 text-sm font-semibold text-foreground">{{ $gettingStartedTitle }}</h3>
                                <ul class="space-y-1">
                                    @foreach($gettingStarted as $slug => $page)
                                        <li>
                                            <a
                                                href="/docs/{{ $slug }}"
                                                class="block rounded-md px-3 py-1.5 text-sm {{ is_docs_page_active($slug) ? 'bg-accent text-accent-foreground font-medium' : 'text-muted-foreground hover:bg-accent/50 hover:text-foreground' }} transition-colors">
                                                {{ $page['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Components -->
                        @php
                            $componentCategories = get_component_categories();
                            $componentsTitle = get_components_title();
                        @endphp

                        @if(!empty($componentCategories))
                            <div>
                                <h3 class="mb-2 text-sm font-semibold text-foreground">{{ $componentsTitle }}</h3>
                                @foreach($componentCategories as $category => $components)
                                    <div class="mb-4">
                                        <h4 class="mb-1 px-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">{{ $category }}</h4>
                                        <ul class="space-y-1">
                                            @foreach($components as $component)
                                                <li>
                                                    <a
                                                        href="/docs/components/{{ $component }}"
                                                        class="block rounded-md px-3 py-1.5 text-sm {{ is_component_active($component) ? 'bg-accent text-accent-foreground font-medium' : 'text-muted-foreground hover:bg-accent/50 hover:text-foreground' }} transition-colors">
                                                        {{ config("docs.navigation.components.library.{$component}.title", Str::title($component)) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </aside>

                <!-- Main content -->
                <main class="relative py-6 lg:py-8 xl:py-12">
                    <div class="mx-auto w-full min-w-0">
                        <div class="mx-auto px-4 lg:px-6 xl:px-8">
                            <!-- Breadcrumb -->
                            @if(isset($page))
                                <nav class="flex mb-6 text-sm text-muted-foreground">
                                    <ol class="flex items-center space-x-2">
                                        <li><a href="/docs" class="hover:text-foreground">Docs</a></li>
                                        <li>/</li>
                                        <li class="text-foreground font-medium">{{ $title }}</li>
                                    </ol>
                                </nav>
                            @endif

                            <!-- Content -->
                            <div class="prose prose-zinc dark:prose-invert max-w-none">
                                <h1 class="scroll-m-20 text-3xl font-bold tracking-tight lg:text-4xl mb-6">
                                    {{ $title }}
                                </h1>

                                <x-markdown-content :content="$content" :copyable="true" />
                            </div>
                        </div>
                    </div>
                </main>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="border-t border-border py-6 md:py-0">
            <div class="container flex flex-col items-center justify-between gap-4 md:h-16 md:flex-row px-4 md:px-6 lg:px-8">
                <p class="text-sm text-muted-foreground">
                    Built with <a href="https://laravel.com" target="_blank" class="font-medium hover:underline">Laravel</a>,
                    <a href="https://livewire.laravel.com" target="_blank" class="font-medium hover:underline">Livewire</a>,
                    and <a href="https://tailwindcss.com" target="_blank" class="font-medium hover:underline">Tailwind CSS</a>.
                </p>
                <p class="text-sm text-muted-foreground">
                    &copy; {{ date('Y') }} Velyx. All rights reserved.
                </p>
            </div>
        </footer>
    </div>

    @livewireScripts

    <script>
        // Theme initialization and management
        function themeToggle() {
            return {
                init() {
                    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
                toggleTheme() {
                    const isDark = document.documentElement.classList.toggle('dark');
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                }
            }
        }

        // Initialize theme on page load
        document.addEventListener('alpine:init', () => {
            Alpine.data('themeToggle', themeToggle);
        });

        // Smooth scrolling for anchor links
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
