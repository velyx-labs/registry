<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>


<div class="min-h-screen bg-background text-foreground">

    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5"></div>

        <div class="relative w-full py-32 md:py-40 lg:py-48">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
                <div class="container flex flex-col items-center gap-2 px-6 py-8 text-center md:py-16 lg:py-20 xl:gap-4">
                    <!-- Title -->
                    <h1 class="text-primary leading-tighter text-3xl font-semibold tracking-tight text-balance lg:leading-[1.1] lg:font-semibold xl:text-5xl xl:tracking-tighter max-w-4xl">
                        Build Beautiful
                        <span class="bg-gradient-to-r from-primary to-primary/60 bg-clip-text text-transparent">
                            Design Systems
                        </span>
                    </h1>

                    <!-- Description -->
                    <p class="text-foreground max-w-4xl text-base text-balance sm:text-lg">
                        Craft stunning user interfaces with our comprehensive collection of beautifully designed,
                        accessible components. Built for developers, designed for users.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="mt-12 flex flex-wrap items-center justify-center gap-6">
                        <x-ui.button size="sm" href="/docs/installation" variant="default">
                            Get Started
                        </x-ui.button>
                        <x-ui.button size="sm" href="/docs/components/button" variant="outline">
                            Browse Components
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Section -->
    <section class="py-24 bg-muted/30">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="mx-auto max-w-6xl">
                <!-- Image avec overlay -->
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <!-- Gradient overlay pour meilleure lisibilité -->
                    <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-black/20 z-10"></div>

                    <!-- Image principale -->
                    <div class="aspect-video md:aspect-[16/9] relative">
                        <img src="https://images.unsplash.com/photo-1770885653473-ca48b4d69173?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             alt="Interface de développement web moderne"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
