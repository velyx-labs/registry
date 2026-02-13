<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<footer class="border-t border-border/40 bg-background/80 backdrop-blur-xl">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <span class="text-xl font-bold tracking-tight">Velyx</span>
                </div>
                <p class="text-muted-foreground mb-4 max-w-md">
                    Beautiful, accessible, and fully customizable components for modern web applications.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-muted-foreground hover:text-foreground transition-colors">
                        <x-icons.github class="h-5 w-5"/>
                    </a>
                    <a href="#" class="text-muted-foreground hover:text-foreground transition-colors">
                        <x-icons.twitter class="h-5 w-5"/>
                    </a>
                    <a href="#" class="text-muted-foreground hover:text-foreground transition-colors">
                        <x-icons.linkedin class="h-5 w-5"/>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="font-semibold mb-4">Documentation</h3>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li><a href="#" class="hover:text-foreground transition-colors">Getting Started</a></li>
                    <li><a href="#" class="hover:text-foreground transition-colors">Components</a></li>
                    <li><a href="#" class="hover:text-foreground transition-colors">Customization</a></li>
                    <li><a href="#" class="hover:text-foreground transition-colors">Examples</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-4">Community</h3>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li><a href="#" class="hover:text-foreground transition-colors">Discord</a></li>
                    <li><a href="#" class="hover:text-foreground transition-colors">GitHub</a></li>
                    <li><a href="#" class="hover:text-foreground transition-colors">Discussions</a></li>
                    <li><a href="#" class="hover:text-foreground transition-colors">Contributing</a></li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-border/40 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto">
            <p class="text-sm text-muted-foreground">
                © 2026 Velyx. All rights reserved.
            </p>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <a href="#" class="text-sm text-muted-foreground hover:text-foreground transition-colors">Privacy
                    Policy</a>
                <a href="#" class="text-sm text-muted-foreground hover:text-foreground transition-colors">Terms of
                    Service</a>
            </div>
        </div>
    </div>
</footer>
