<?php



use Livewire\Component;

new class extends Component {
    //
};
?>

<header
    class="sticky top-0 z-50 w-full border-b border-border/40 bg-background/80 backdrop-blur-xl supports-backdrop-filter:bg-background/60"
    x-data="{ mobileMenuOpen: false }">
    <div
        class="mx-auto max-w-screen-2xl flex h-16 items-center justify-between px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <!-- Logo -->
        <div class="flex items-center">
            <a class="flex items-center space-x-3 transition-opacity hover:opacity-80" href="/">
                <span class="text-xl font-bold tracking-tight">Velyx</span>
            </a>
        </div>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center space-x-1">
            <x-ui.button variant="outline">Components</x-ui.button>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="hidden lg:flex relative">
                <x-ui.input type="text" placeholder="Search components..." />
            </div>

            <!-- Theme Toggle -->
            <button
                x-data="{ darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
                x-init="
                    darkMode = localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    $watch('darkMode', value => {
                        localStorage.setItem('theme', value ? 'dark' : 'light');
                        if (value) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    });
                    if (darkMode) document.documentElement.classList.add('dark');
                " @click="darkMode = !darkMode"
                class="relative h-9 w-9 rounded-md hover:bg-accent hover:text-accent-foreground inline-flex items-center justify-center transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                aria-label="Toggle theme">
                <x-lucide-sun class="h-4 w-4 transition-all dark:hidden" />
                <x-lucide-moon class="h-4 w-4 transition-all hidden dark:block" />
            </button>

            <!-- GitHub -->
            <x-ui.button variant="ghost" size="sm" class="size-9 px-0" href="https://github.com/velyx-labs/ui">
                <x-icons.github class="size-9" />
            </x-ui.button>

            <!-- CTA -->
            <x-ui.button variant="default" class="hidden sm:inline-flex">
                Get Started
            </x-ui.button>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden relative h-9 w-9 rounded-md hover:bg-accent hover:text-accent-foreground inline-flex items-center justify-center transition-colors"
                aria-label="Toggle menu">
                <x-lucide-menu class="h-4 w-4" x-show="!mobileMenuOpen" />
                <x-lucide-x class="h-4 w-4" x-show="mobileMenuOpen" />
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden border-t border-border/40 bg-background"
        style="display: none;">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 md:px-6 lg:px-8">
            <nav class="flex flex-col space-y-3">
                <x-ui.button href="/components" variant="link">
                    Components
                </x-ui.button>

                <div class="relative pt-4 lg:hidden">
                    <x-lucide-search class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                    <x-ui.input type="text" placeholder="Search components..."
                        class="h-9 w-full rounded-md border border-input bg-background pl-10 pr-3 text-sm ring-offset-background transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" />
                </div>
            </nav>
        </div>
    </div>
</header>