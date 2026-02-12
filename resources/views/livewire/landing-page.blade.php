<div class="min-h-screen bg-background text-foreground">
    <!-- Navigation -->
    <header
        class="sticky top-0 z-50 w-full border-b border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
        <div class="container flex h-14 max-w-screen-2xl items-center">
            <!-- Logo -->
            <div class="mr-4 flex">
                <a class="mr-6 flex items-center space-x-2" href="/">
                    <span class="font-bold">Velyx</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex items-center space-x-6 text-sm font-medium">
                <x-ui.button href="/docs">Docs</x-ui.button>
                <x-ui.button href="/components">Components</x-ui.button>
                <x-ui.button href="/blocks">Blocks</x-ui.button>
                <x-ui.button href="/charts">Charts</x-ui.button>
                <x-ui.button href="/directory">Directory</x-ui.button>
                <x-ui.button href="/create">Create</x-ui.button>
            </nav>

            <!-- Search -->
            <div class="flex-1"></div>
            <div class="relative">
                <input type="text" placeholder="Search documentation..."
                    class="h-9 w-64 rounded-md border border-input bg-background px-3 py-1 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
            </div>

            <!-- Right Actions -->
            <div class="flex items-center space-x-4">
                <a href="https://github.com/velyx/velyx" class="text-muted-foreground hover:text-foreground">
                    <x-lucide-github class="w-5 h-5" />
                </a>
                <x-ui.button variant="default">New Project</x-ui.button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container max-w-screen-2xl py-24 md:py-32">
        <div class="mx-auto flex max-w-[980px] flex-col items-center text-center">
            <!-- Badge -->
            <div class="mb-6">
                <x-ui.badge variant="secondary">RTL Support →</x-ui.badge>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold tracking-tight text-foreground sm:text-5xl md:text-6xl lg:text-7xl">
                The Foundation for your
                <br />
                Design System
            </h1>

            <!-- Description -->
            <p class="mt-6 max-w-150 text-lg text-muted-foreground sm:text-xl">
                A set of beautifully designed components that you can customize, extend, and build on.
                Start here then make it your own. Open Source. Open Code.
            </p>

            <!-- CTA Buttons -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <x-ui.button size="lg" variant="default">Get Started</x-ui.button>
                <x-ui.button size="lg" variant="ghost">View Components</x-ui.button>
            </div>
        </div>
    </section>

    <!-- Examples Navigation -->
    <section class="container mx-auto max-w-screen-2xl py-12">
        <div class="mx-auto max-w-245">
            <x-ui.tabs>
                <x-ui.tabs.list>
                    <x-ui.tabs.trigger value="examples">Examples</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="dashboard">Dashboard</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="tasks">Tasks</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="playground">Playground</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="authentication">Authentication</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="rtl">RTL</x-ui.tabs.trigger>
                </x-ui.tabs.list>

                <!-- Examples Tab -->
                <x-ui.tabs.content value="examples">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <!-- Payment Form Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Payment Method</h3>
                                <div class="space-y-4">
                                    <div>
                                        <x-ui.label>Name on Card</x-ui.label>
                                        <x-ui.input type="text" placeholder="John Doe" />
                                    </div>
                                    <div>
                                        <x-ui.label>Card Number</x-ui.label>
                                        <x-ui.input type="text" placeholder="1234 5678 9012 3456" />
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <x-ui.label>CVV</x-ui.label>
                                            <x-ui.input type="text" placeholder="123" />
                                        </div>
                                        <div>
                                            <x-ui.label>Month</x-ui.label>
                                            <select
                                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                                <option>06</option>
                                                <option>07</option>
                                                <option>08</option>
                                                <option>09</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" id="same-shipping"
                                            class="h-4 w-4 rounded border border-primary">
                                        <x-ui.label for="same-shipping">Same as shipping address</x-ui.label>
                                    </div>
                                    <div>
                                        <x-ui.label>Comments</x-ui.label>
                                        <textarea
                                            class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                                            placeholder="Additional notes..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Invite Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">No Team Members</h3>
                                <p class="text-muted-foreground mb-4">
                                    Invite team members to collaborate on this project.
                                </p>
                                <x-ui.button class="w-full">Invite Members</x-ui.button>
                            </div>
                        </div>

                        <!-- Auth Settings Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Security</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-medium">Two-factor authentication</h4>
                                            <p class="text-sm text-muted-foreground">Add an extra layer of security</p>
                                        </div>
                                        <x-ui.button>Enable</x-ui.button>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-medium">Email verification</h4>
                                            <p class="text-sm text-muted-foreground">Verify your email address</p>
                                        </div>
                                        <span class="text-sm text-green-600">Verified</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Input Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Messages</h3>
                                <div class="space-y-4">
                                    <input type="text" placeholder="Send a message..."
                                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                                    <div class="flex space-x-2">
                                        <x-ui.button variant="ghost" size="sm">
                                            <x-lucide-plus class="w-4 h-4" />
                                        </x-ui.button>
                                        <x-ui.button variant="ghost" size="sm">
                                            <x-lucide-paperclip class="w-4 h-4" />
                                        </x-ui.button>
                                        <span class="text-sm text-blue-600">Syncing</span>
                                        <span class="text-sm text-orange-600">Updating</span>
                                        <span class="text-sm text-green-600">Loading</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Range Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Price Range</h3>
                                <div class="space-y-4">
                                    <input type="range" min="0" max="1000" class="w-full">
                                    <input type="text" placeholder="Search products..."
                                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                                </div>
                            </div>
                        </div>

                        <!-- Infrastructure Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Compute Environment</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-2">
                                        <input type="radio" name="infra" id="k8s" class="h-4 w-4" checked>
                                        <x-ui.label for="k8s">Kubernetes</x-ui.label>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="radio" name="infra" id="vm" class="h-4 w-4">
                                        <x-ui.label for="vm">Virtual Machine</x-ui.label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Survey Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">How did you hear about us?</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <input type="radio" name="source" id="social" class="h-4 w-4">
                                        <x-ui.label for="social">Social Media</x-ui.label>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="radio" name="source" id="search" class="h-4 w-4">
                                        <x-ui.label for="search">Search Engine</x-ui.label>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="radio" name="source" id="referral" class="h-4 w-4">
                                        <x-ui.label for="referral">Referral</x-ui.label>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="radio" name="source" id="other" class="h-4 w-4">
                                        <x-ui.label for="other">Other</x-ui.label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Legal Card -->
                        <div class="relative rounded-xl border bg-card text-card-foreground shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Terms & Conditions</h3>
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" id="terms" class="h-4 w-4">
                                    <x-ui.label for="terms">I agree to the terms and conditions</x-ui.label>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-ui.tabs.content>
            </x-ui.tabs>
        </div>
    </section>
</div>
