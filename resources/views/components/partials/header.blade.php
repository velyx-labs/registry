<?php

use Livewire\Component;

new class extends Component {
};
?>

<header class="sticky top-0 z-50 w-full border-b border-border/50 bg-background/90 backdrop-blur supports-backdrop-filter:bg-background/75">
    <div class="px-6 lg:px-12 xl:px-24">
        <div class="flex h-14 items-center justify-between gap-6 max-w-7xl mx-auto">

            {{-- Logo --}}
            <x-ui.button href="{{ route('home') }}" wire:navigate variant="ghost" class="gap-2 px-0 hover:bg-transparent">
                <img class="h-6 w-6 dark:hidden" src="{{ asset('assets/img/logo.svg') }}" alt="Velyx" width="24" height="24">
                <img class="hidden h-6 w-6 dark:block" src="{{ asset('assets/img/logo-dark.svg') }}" alt="Velyx" width="24" height="24">
                <span class="text-[15px] font-semibold tracking-tight text-foreground">Velyx</span>
            </x-ui.button>

            {{-- Nav --}}
            <nav class="flex flex-1 items-center gap-0.5" aria-label="Main navigation">
                <x-ui.button href="{{ route('docs.page', 'installation') }}" wire:navigate variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                    Docs
                </x-ui.button>
                <x-ui.button href="{{ route('docs.page', 'components') }}" wire:navigate variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                    Components
                </x-ui.button>
            </nav>

            {{-- Right actions --}}
            <div class="flex items-center gap-1.5">

                {{-- Buy Me a Coffee --}}
                <a
                    href="https://gvcjmaad.mychariow.shop/velyx-dev"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex h-8 shrink-0 items-center justify-center gap-1.5 rounded-md px-2.5 text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                    style="background: rgba(245,78,0,0.08); color: #f54e00; border: 1px solid rgba(245,78,0,0.18);"
                    onmouseover="this.style.background='rgba(245,78,0,0.14)'"
                    onmouseout="this.style.background='rgba(245,78,0,0.08)'"
                    aria-label="Support the project on Buy Me a Coffee"
                >
                    <x-lucide-coffee class="h-3.5 w-3.5 shrink-0" />
                    <span class="hidden sm:inline">Support</span>
                </a>

                {{-- GitHub --}}
                <a
                    href="https://github.com/velyx-labs/velyx"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex size-9 shrink-0 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                    aria-label="View on GitHub"
                >
                    <x-icons.github class="h-4 w-4" />
                </a>

                {{-- Dark mode toggle --}}
                <button
                    type="button"
                    class="dark-mode-toggle inline-flex size-9 shrink-0 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                    aria-label="Toggle dark mode"
                >
                    <x-lucide-sun class="h-4 w-4 dark:hidden" />
                    <x-lucide-moon class="hidden h-4 w-4 dark:block" />
                </button>

            </div>
        </div>
    </div>
</header>
