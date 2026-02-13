<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<header
    class="sticky top-0 z-50 w-full border-b border-border/40 bg-background/80 backdrop-blur-xl supports-backdrop-filter:bg-background/60">
    <div
        class="mx-auto max-w-screen-2xl flex h-16 items-center justify-between px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <!-- Logo -->
        <div class="flex items-center">
            <a class="flex items-center space-x-3 transition-opacity hover:opacity-80" href="/">

                <span class="text-xl font-bold tracking-tight">Velyx</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center space-x-1">
            <x-ui.button href="/docs" variant="link" >Docs</x-ui.button>
            <x-ui.button variant="link" >Components</x-ui.button>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="hidden lg:flex relative">
                <x-lucide-search class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground"/>
                <input
                    type="text"
                    placeholder="Search docs..."
                    class="h-9 w-64 rounded-md border border-input bg-background pl-10 pr-3 text-sm ring-offset-background transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
            </div>

<!-- Theme Toggle -->
            <x-ui.button variant="ghost" size="sm" @click="toggleDarkMode()">
                <x-lucide-sun class="dark:hidden block size-4 rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0"/>
                <x-lucide-moon class="dark:block size-4 rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100"/>
            </x-ui.button>

            <!-- GitHub -->
            <x-ui.button variant="ghost" size="sm" class="size-9 px-0" href="https://github.com/velyx-labs">
                <x-icons.github class="size-9"/>
            </x-ui.button>

            <!-- CTA -->
            <x-ui.button variant="default" class="hidden sm:inline-flex">
                Get Started
            </x-ui.button>

            <!-- Mobile Menu -->
            <x-ui.button variant="ghost" size="sm" class="md:hidden h-9 w-9 px-0">
                <x-lucide-menu class="h-4 w-4"/>
            </x-ui.button>
        </div>
    </div>
</header>
