<div class="min-h-screen bg-background text-foreground">
    <!-- Hero Section -->
    <section class="py-24 md:py-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="text-muted-foreground text-sm font-medium mb-4">
                Open Source. CLI-first.
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-foreground mb-6">
                Build Laravel interfaces at velocity.
            </h1>
            
            <p class="mt-6 text-lg text-muted-foreground max-w-2xl mx-auto">
                A CLI-driven component system inspired by modern composability.
            </p>
            
            <!-- CLI Command Block -->
            <div class="mt-8 bg-muted border border-border rounded-lg p-4 text-sm font-mono max-w-md mx-auto relative group">
                <code>npx velyx init</code>
                <button 
                    x-data="{ copied: false }"
                    @click="navigator.clipboard.writeText('npx velyx init'); copied = true; setTimeout(() => copied = false, 2000)"
                    class="absolute right-2 top-2 text-muted-foreground hover:text-foreground transition-colors"
                    x-text="copied ? 'Copied!' : 'Copy'"
                ></button>
            </div>
            
            <!-- CTA Buttons -->
            <div class="mt-8 flex justify-center gap-4">
                <x-ui.button variant="primary" size="lg">
                    Get Started
                </x-ui.button>
                <x-ui.button variant="outline" size="lg">
                    GitHub
                </x-ui.button>
            </div>
        </div>
    </section>

    <!-- Problem Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold">
                Stop rewriting the same Blade components.
            </h2>
            
            <ul class="mt-6 space-y-3">
                <li class="flex items-center">
                    <x-lucide-x-circle class="w-5 h-5 mr-3 text-destructive" />
                    Repeated UI boilerplate
                </li>
                <li class="flex items-center">
                    <x-lucide-x-circle class="w-5 h-5 mr-3 text-destructive" />
                    Unstructured component growth
                </li>
                <li class="flex items-center">
                    <x-lucide-x-circle class="w-5 h-5 mr-3 text-destructive" />
                    Inconsistent design systems
                </li>
                <li class="flex items-center">
                    <x-lucide-x-circle class="w-5 h-5 mr-3 text-destructive" />
                    Time lost on setup instead of shipping
                </li>
            </ul>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-center text-foreground mb-12">
                How It Works
            </h2>
            
            <div class="md:grid md:grid-cols-3 gap-12">
                <div class="border border-border rounded-lg p-6 bg-muted">
                    <div class="text-primary mb-4">
                        <x-lucide-terminal class="w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-foreground mb-2">CLI First</h3>
                    <p class="text-muted-foreground">
                        Add components directly into your project with simple commands.
                    </p>
                </div>
                
                <div class="border border-border rounded-lg p-6 bg-muted">
                    <div class="text-primary mb-4">
                        <x-lucide-code class="w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-foreground mb-2">Own Code</h3>
                    <p class="text-muted-foreground">
                        No hidden runtime. You fully control your components.
                    </p>
                </div>
                
                <div class="border border-border rounded-lg p-6 bg-muted">
                    <div class="text-primary mb-4">
                        <x-lucide-blocks class="w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-foreground mb-2">Composable</h3>
                    <p class="text-muted-foreground">
                        Build and extend your own design system.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Example Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-center text-foreground mb-12">
                Simple Usage
            </h2>
            
            <div class="space-y-6">
                <div class="bg-muted border border-border rounded-lg p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-muted-foreground">Component Usage</span>
                        <button 
                            x-data="{ copied: false }"
                            {{-- @click="navigator.clipboard.writeText('<x-button variant=\"primary\">Save</x-button>'); copied = true; setTimeout(() => copied = false, 2000)" --}}
                            class="text-muted-foreground hover:text-foreground transition-colors"
                            {{-- x-text="copied ? 'Copied!' : 'Copy'" --}}
                        ></button>
                    </div>
                    <pre class="font-mono text-sm text-foreground">&lt;x-button variant="primary"&gt;Save&lt;/x-button&gt;</pre>
                </div>
                
                <div class="bg-muted border border-border rounded-lg p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-muted-foreground">CLI Command</span>
                        <button 
                            x-data="{ copied: false }"
                            @click="navigator.clipboard.writeText('npx velyx add button'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="text-muted-foreground hover:text-foreground transition-colors"
                            x-text="copied ? 'Copied!' : 'Copy'"
                        ></button>
                    </div>
                    <pre class="font-mono text-sm text-foreground">npx velyx add button</pre>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold text-foreground mb-6">
                Not just another Blade component kit.
            </h2>
            
            <p class="mt-6 text-muted-foreground max-w-2xl mx-auto text-lg">
                Velyx is a workflow. A system. A foundation for your Laravel UI architecture.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-background text-muted-foreground border-t border-border py-12 text-center">
        <div class="max-w-7xl mx-auto px-6">
            <p>© 2026 Velyx. Open Source.</p>
        </div>
    </footer>
</div>