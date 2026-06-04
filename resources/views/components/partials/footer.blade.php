<?php

use Livewire\Component;

new class extends Component {
};
?>

<footer class="border-t border-border bg-background" role="contentinfo">
    <div class="px-6 lg:px-12 xl:px-24 py-14 lg:py-20">
        <div class="max-w-7xl mx-auto">

        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-[1.5fr_1fr_1fr]">

            {{-- Brand --}}
            <div class="flex flex-col gap-5 sm:col-span-2 lg:col-span-1">

                <x-ui.button href="{{ route('home') }}" wire:navigate variant="ghost" class="w-fit gap-2 px-0 hover:bg-transparent">
                    <img class="h-6 w-6 dark:hidden" src="{{ asset('assets/img/logo.svg') }}" alt="Velyx" width="24" height="24">
                    <img class="hidden h-6 w-6 dark:block" src="{{ asset('assets/img/logo-dark.svg') }}" alt="Velyx" width="24" height="24">
                    <span class="text-[15px] font-semibold tracking-tight text-foreground">Velyx</span>
                </x-ui.button>

                <p class="max-w-xs text-sm leading-relaxed text-muted-foreground">
                    Copy the component, adapt the markup, ship interfaces that still feel like your product — not a package.
                </p>

                {{-- Command hint --}}
                <div class="inline-flex w-fit items-center gap-2 rounded-lg border border-border bg-muted px-3 py-2 font-mono text-xs text-muted-foreground">
                    <x-icons.terminal class="h-3.5 w-3.5 shrink-0 opacity-50" />
                    npx velyx@latest add button
                </div>

                <div class="flex flex-wrap gap-2">
                    <x-ui.button href="{{ route('docs.page', 'installation') }}" wire:navigate size="sm" iconRight="arrow-right">
                        Get started
                    </x-ui.button>
                    <x-ui.button href="https://github.com/velyx-labs/registry" target="_blank" rel="noopener noreferrer" variant="outline" size="sm" icon="icons.github" :lucide="false">
                        GitHub
                    </x-ui.button>
                </div>
            </div>

            {{-- Explore --}}
            <div class="flex flex-col gap-4">
                <p class="font-mono text-xs uppercase tracking-wider text-muted-foreground/50">Explore</p>
                <div class="flex flex-col items-start -ml-3">
                    <x-ui.button href="{{ route('docs.page', 'installation') }}" wire:navigate variant="link" size="sm" class="text-muted-foreground hover:text-foreground">
                        Get Started
                    </x-ui.button>
                    <x-ui.button href="{{ route('docs.page', 'components') }}" wire:navigate variant="link" size="sm" class="text-muted-foreground hover:text-foreground">
                        Components
                    </x-ui.button>
                    <x-ui.button href="{{ route('docs.index') }}" wire:navigate variant="link" size="sm" class="text-muted-foreground hover:text-foreground">
                        Documentation
                    </x-ui.button>
                </div>
            </div>

            {{-- Community --}}
            <div class="flex flex-col gap-4">
                <p class="font-mono text-xs uppercase tracking-wider text-muted-foreground/50">Community</p>
                <div class="flex flex-col items-start -ml-3">
                    <x-ui.button href="https://github.com/velyx-labs/registry" target="_blank" rel="noopener noreferrer" variant="link" size="sm" class="text-muted-foreground hover:text-foreground">
                        GitHub
                    </x-ui.button>
                    <x-ui.button href="https://x.com/velyxdev" target="_blank" rel="noopener noreferrer" variant="link" size="sm" class="text-muted-foreground hover:text-foreground">
                        X (Twitter)
                    </x-ui.button>
                    <x-ui.button href="https://gvcjmaad.mychariow.shop/velyx-dev" target="_blank" rel="noopener noreferrer" variant="link" size="sm" iconLeft="heart" class="text-muted-foreground hover:text-foreground">
                        Support
                    </x-ui.button>
                </div>
            </div>

        </div>

        <x-ui.separator class="my-8" />

        <div class="flex flex-col gap-2 text-xs text-muted-foreground/60 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} Velyx. UI components for Laravel teams that value ownership.</p>
            <p class="flex items-center gap-1">
                Inspired by
                <x-ui.button href="https://ui.shadcn.com?utm_source={{ url()->current() }}" target="_blank" rel="noopener noreferrer" variant="link" class="h-auto p-0 text-xs text-muted-foreground/60 hover:text-muted-foreground">
                    shadcn/ui
                </x-ui.button>
            </p>
        </div>

        </div><!-- /.max-w-7xl -->
    </div>
</footer>
