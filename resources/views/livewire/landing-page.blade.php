<div class="min-h-screen bg-background text-foreground">
    <!-- Navigation -->
    <header
        class="sticky top-0 z-50 w-full border-b border-border/40 bg-background/80 backdrop-blur-xl supports-[backdrop-filter]:bg-background/60">
        <div
            class="mx-auto max-w-screen-2xl flex h-16 items-center justify-between px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a class="flex items-center space-x-3 transition-opacity hover:opacity-80" href="/">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary">
                        <span class="text-sm font-bold text-primary-foreground">V</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight">Velyx</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-1">
                <x-ui.button variant="ghost" class="px-4 py-2 text-sm font-medium">Docs</x-ui.button>
                <x-ui.button variant="ghost" class="px-4 py-2 text-sm font-medium">Components</x-ui.button>
                <x-ui.button variant="ghost" class="px-4 py-2 text-sm font-medium">Blocks</x-ui.button>
                <x-ui.button variant="ghost" class="px-4 py-2 text-sm font-medium">Charts</x-ui.button>
                <x-ui.button variant="ghost" class="px-4 py-2 text-sm font-medium">Directory</x-ui.button>
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
                <x-ui.button variant="ghost" size="sm" class="h-9 w-9 px-0">
                    <x-lucide-sun class="h-4 w-4 rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0"/>
                    <x-lucide-moon
                        class="absolute h-4 w-4 rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100"/>
                </x-ui.button>

                <!-- GitHub -->
                <x-ui.button variant="ghost" size="sm" class="h-9 w-9 px-0" href="https://github.com/velyx/velyx">
                    <x-lucide-github class="h-4 w-4"/>
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

    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5"></div>
        <div class="absolute inset-0 opacity-20"
             style="background-image: url('data:image/svg+xml;utf8,<svg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><g fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;><g fill=&quot;%23e5e7eb&quot; fill-opacity=&quot;0.1&quot;><circle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;2&quot;/></g></g></svg>')"></div>

        <div class="relative w-full py-32 md:py-40 lg:py-48">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
                <div class="mx-auto flex max-w-6xl flex-col items-center text-center">


                    <!-- Title -->
                    <h1 class="animate-fade-in-up text-5xl font-bold tracking-tight text-foreground sm:text-6xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-[8rem] leading-none">
                        Build Beautiful
                        <span class="bg-linear-to-r from-primary to-primary/60 bg-clip-text text-transparent">
                        Design Systems
                    </span>
                    </h1>

                    <!-- Description -->
                    <p class="animate-fade-in-up mt-8 max-w-4xl text-xl text-muted-foreground sm:text-xs lg:text-xl xl:text-2xl 2xl:text-3xl leading-relaxed">
                        Craft stunning user interfaces with our comprehensive collection of beautifully designed,
                        accessible components. Built for developers, designed for users.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="animate-fade-in-up mt-12 flex flex-wrap items-center justify-center gap-6 lg:gap-8">
                        <x-ui.button size="lg" variant="default" class="transition-all duration-300">

                            Get Started Free
                        </x-ui.button>
                        <x-ui.button size="lg" variant="outline" class="hover:bg-muted/50">

                            Watch Demo
                        </x-ui.button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Examples Navigation -->
    <section class="py-24 bg-muted/30">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="mx-auto max-w-none">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold tracking-tight text-foreground sm:text-4xl lg:text-5xl xl:text-6xl">
                        Beautiful Components
                    </h2>
                    <p class="mt-4 text-lg lg:text-xl xl:text-2xl text-muted-foreground max-w-4xl mx-auto">
                        Explore our collection of professionally designed components and patterns
                    </p>
                </div>

                <x-ui.tabs default="examples" class="w-full">
                    <x-ui.tabs.list class="grid w-full max-w-4xl mx-auto grid-cols-3 lg:grid-cols-6 mb-12">
                        <x-ui.tabs.trigger value="examples" class="text-sm lg:text-base">Examples</x-ui.tabs.trigger>
                        <x-ui.tabs.trigger value="dashboard" class="text-sm lg:text-base">Dashboard</x-ui.tabs.trigger>
                        <x-ui.tabs.trigger value="tasks" class="text-sm lg:text-base">Tasks</x-ui.tabs.trigger>
                        <x-ui.tabs.trigger value="playground" class="text-sm lg:text-base">Playground
                        </x-ui.tabs.trigger>
                        <x-ui.tabs.trigger value="authentication" class="text-sm lg:text-base">Auth</x-ui.tabs.trigger>
                        <x-ui.tabs.trigger value="rtl" class="text-sm lg:text-base">RTL</x-ui.tabs.trigger>
                    </x-ui.tabs.list>

                    <!-- Examples Tab -->
                    <x-ui.tabs.content value="examples">
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 lg:gap-8">
                            <!-- Payment Form Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold">Payment Method</h3>
                                        <div class="h-2 w-2 rounded-full bg-green-500"></div>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="space-y-2">
                                            <x-ui.label class="text-sm font-medium">Name on Card</x-ui.label>
                                            <x-ui.input type="text" placeholder="John Doe" class="h-10"/>
                                        </div>
                                        <div class="space-y-2">
                                            <x-ui.label class="text-sm font-medium">Card Number</x-ui.label>
                                            <x-ui.input type="text" placeholder="1234 5678 9012 3456" class="h-10"/>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div class="space-y-2">
                                                <x-ui.label class="text-sm font-medium">CVV</x-ui.label>
                                                <x-ui.input type="text" placeholder="123" class="h-10"/>
                                            </div>
                                            <div class="space-y-2">
                                                <x-ui.label class="text-sm font-medium">Expiry</x-ui.label>
                                                <select
                                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                                    <option>12/26</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2 pt-2">
                                            <input type="checkbox" id="save-card"
                                                   class="h-4 w-4 rounded border border-primary accent-primary">
                                            <x-ui.label for="save-card" class="text-sm">Save for future use</x-ui.label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Invite Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <div class="text-center">
                                        <div
                                            class="mx-auto h-12 w-12 rounded-full bg-muted flex items-center justify-center mb-4">
                                            <x-lucide-users class="h-6 w-6 text-muted-foreground"/>
                                        </div>
                                        <h3 class="text-lg font-semibold mb-2">Invite Team</h3>
                                        <p class="text-sm text-muted-foreground mb-6 leading-relaxed">
                                            Collaborate with your team members on this project.
                                        </p>
                                        <x-ui.button class="w-full">
                                            <x-lucide-plus class="mr-2 h-4 w-4"/>
                                            Invite Members
                                        </x-ui.button>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Settings Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <h3 class="text-lg font-semibold">Security</h3>
                                        <x-lucide-shield-check class="h-5 w-5 text-emerald-500"/>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between py-2">
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-medium">Two-Factor Auth</h4>
                                                <p class="text-xs text-muted-foreground">Extra layer of security</p>
                                            </div>
                                            <x-ui.button size="sm" variant="outline">Enable</x-ui.button>
                                        </div>
                                        <div class="flex items-center justify-between py-2">
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-medium">Email Verification</h4>
                                                <p class="text-xs text-muted-foreground">Verify your email</p>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                                                <span class="text-xs text-emerald-600 font-medium">Verified</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Analytics Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <h3 class="text-lg font-semibold mb-4">Analytics</h3>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-muted-foreground">Page Views</span>
                                            <span class="text-2xl font-bold">12.4K</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-muted-foreground">Bounce Rate</span>
                                            <span class="text-sm font-medium text-emerald-600">-12%</span>
                                        </div>
                                        <div class="h-2 bg-muted rounded-full overflow-hidden">
                                            <div class="h-full w-3/4 bg-primary rounded-full"></div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="flex items-center space-x-1">
                                                <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                                                <span class="text-xs text-muted-foreground">Active</span>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <div class="h-2 w-2 rounded-full bg-yellow-500"></div>
                                                <span class="text-xs text-muted-foreground">Processing</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notification Settings Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-orange-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <h3 class="text-lg font-semibold mb-4">Notifications</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm">Email Updates</span>
                                            <input type="checkbox" checked class="h-4 w-4 rounded accent-primary">
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm">Push Notifications</span>
                                            <input type="checkbox" class="h-4 w-4 rounded accent-primary">
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm">SMS Alerts</span>
                                            <input type="checkbox" checked class="h-4 w-4 rounded accent-primary">
                                        </div>
                                        <div class="pt-2">
                                            <x-ui.button variant="outline" size="sm" class="w-full">
                                                Customize
                                            </x-ui.button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- API Keys Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-red-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <h3 class="text-lg font-semibold mb-4">API Keys</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-center space-x-3 p-2 bg-muted/50 rounded-md">
                                            <x-lucide-key class="h-4 w-4 text-muted-foreground"/>
                                            <span class="text-xs font-mono flex-1">sk-proj-***</span>
                                            <x-ui.button size="sm" variant="ghost" class="h-6 w-6 p-0">
                                                <x-lucide-copy class="h-3 w-3"/>
                                            </x-ui.button>
                                        </div>
                                        <div class="text-xs text-muted-foreground">
                                            Last used: 2 hours ago
                                        </div>
                                        <x-ui.button variant="outline" size="sm" class="w-full">
                                            Generate New Key
                                        </x-ui.button>
                                    </div>
                                </div>
                            </div>

                            <!-- Storage Usage Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-cyan-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <h3 class="text-lg font-semibold mb-4">Storage</h3>
                                    <div class="space-y-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-muted-foreground">Used</span>
                                                <span class="font-medium">2.4 GB / 5 GB</span>
                                            </div>
                                            <div class="h-2 bg-muted rounded-full overflow-hidden">
                                                <div
                                                    class="h-full w-2/5 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full"></div>
                                            </div>
                                        </div>
                                        <div class="text-xs text-muted-foreground">
                                            Free up space or upgrade your plan
                                        </div>
                                        <x-ui.button variant="outline" size="sm" class="w-full">
                                            Manage Storage
                                        </x-ui.button>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions Card -->
                            <div
                                class="group relative rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-300">
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-br from-indigo-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative p-6">
                                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                                    <div class="grid grid-cols-2 gap-2">
                                        <x-ui.button variant="ghost" size="sm"
                                                     class="h-auto p-3 flex flex-col items-center space-y-1">
                                            <x-lucide-file-plus class="h-4 w-4"/>
                                            <span class="text-xs">New File</span>
                                        </x-ui.button>
                                        <x-ui.button variant="ghost" size="sm"
                                                     class="h-auto p-3 flex flex-col items-center space-y-1">
                                            <x-lucide-folder-plus class="h-4 w-4"/>
                                            <span class="text-xs">New Folder</span>
                                        </x-ui.button>
                                        <x-ui.button variant="ghost" size="sm"
                                                     class="h-auto p-3 flex flex-col items-center space-y-1">
                                            <x-lucide-upload class="h-4 w-4"/>
                                            <span class="text-xs">Upload</span>
                                        </x-ui.button>
                                        <x-ui.button variant="ghost" size="sm"
                                                     class="h-auto p-3 flex flex-col items-center space-y-1">
                                            <x-lucide-share-2 class="h-4 w-4"/>
                                            <span class="text-xs">Share</span>
                                        </x-ui.button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-ui.tabs.content>

                    <!-- Placeholder for other tabs -->
                    <x-ui.tabs.content value="dashboard">
                        <div class="text-center py-12">
                            <h3 class="text-lg font-semibold mb-2">Dashboard Components</h3>
                            <p class="text-muted-foreground">Coming soon...</p>
                        </div>
                    </x-ui.tabs.content>

                    <x-ui.tabs.content value="tasks">
                        <div class="text-center py-12">
                            <h3 class="text-lg font-semibold mb-2">Task Management</h3>
                            <p class="text-muted-foreground">Coming soon...</p>
                        </div>
                    </x-ui.tabs.content>

                    <x-ui.tabs.content value="playground">
                        <div class="text-center py-12">
                            <h3 class="text-lg font-semibold mb-2">Interactive Playground</h3>
                            <p class="text-muted-foreground">Coming soon...</p>
                        </div>
                    </x-ui.tabs.content>

                    <x-ui.tabs.content value="authentication">
                        <div class="text-center py-12">
                            <h3 class="text-lg font-semibold mb-2">Authentication Forms</h3>
                            <p class="text-muted-foreground">Coming soon...</p>
                        </div>
                    </x-ui.tabs.content>

                    <x-ui.tabs.content value="rtl">
                        <div class="text-center py-12">
                            <h3 class="text-lg font-semibold mb-2">RTL Support</h3>
                            <p class="text-muted-foreground">Coming soon...</p>
                        </div>
                    </x-ui.tabs.content>
                </x-ui.tabs>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="mx-auto max-w-6xl">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold tracking-tight text-foreground sm:text-4xl lg:text-5xl xl:text-6xl">
                        Why Choose Velyx?
                    </h2>
                    <p class="mt-4 text-lg lg:text-xl xl:text-2xl text-muted-foreground max-w-4xl mx-auto">
                        Built with modern development practices and attention to detail
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                            <x-lucide-zap class="h-6 w-6 text-primary"/>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Lightning Fast</h3>
                        <p class="text-muted-foreground">
                            Optimized for performance with minimal bundle size and fast loading times.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                            <x-lucide-palette class="h-6 w-6 text-primary"/>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Fully Customizable</h3>
                        <p class="text-muted-foreground">
                            Every component can be customized to match your brand and design system.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                            <x-lucide-shield-check class="h-6 w-6 text-primary"/>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Accessible by Default</h3>
                        <p class="text-muted-foreground">
                            Built with accessibility in mind, following WCAG guidelines and best practices.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                            <x-lucide-code-2 class="h-6 w-6 text-primary"/>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Developer Friendly</h3>
                        <p class="text-muted-foreground">
                            Clean, semantic code with excellent TypeScript support and documentation.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                            <x-lucide-smartphone class="h-6 w-6 text-primary"/>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Mobile First</h3>
                        <p class="text-muted-foreground">
                            Responsive design that works beautifully on all devices and screen sizes.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                            <x-lucide-heart class="h-6 w-6 text-primary"/>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Open Source</h3>
                        <p class="text-muted-foreground">
                            Free and open source with a vibrant community of contributors.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-muted/30">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-foreground sm:text-4xl lg:text-5xl xl:text-6xl mb-4">
                    Ready to build something amazing?
                </h2>
                <p class="text-xl lg:text-2xl xl:text-3xl text-muted-foreground mb-8">
                    Join thousands of developers who are already building with Velyx
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4 lg:gap-8">
                    <x-ui.button size="lg" variant="default">
                        Get Started
                    </x-ui.button>
                    <x-ui.button size="lg" variant="outline">
                        View on GitHub
                    </x-ui.button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-border/40 bg-background/80 backdrop-blur-xl">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary">
                            <span class="text-sm font-bold text-primary-foreground">V</span>
                        </div>
                        <span class="text-xl font-bold tracking-tight">Velyx</span>
                    </div>
                    <p class="text-muted-foreground mb-4 max-w-md">
                        Beautiful, accessible, and fully customizable components for modern web applications.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-muted-foreground hover:text-foreground transition-colors">
                            <x-lucide-github class="h-5 w-5"/>
                        </a>
                        <a href="#" class="text-muted-foreground hover:text-foreground transition-colors">
                            <x-lucide-twitter class="h-5 w-5"/>
                        </a>
                        <a href="#" class="text-muted-foreground hover:text-foreground transition-colors">
                            <x-lucide-linkedin class="h-5 w-5"/>
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
</div>
