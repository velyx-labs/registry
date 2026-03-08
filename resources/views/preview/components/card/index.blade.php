@props([
    'props' => [],
])

@php
    $title = (string) ($props['title'] ?? 'Login to your account');
    $description = (string) ($props['description'] ?? 'Enter your email below to login to your account');
    $emailPlaceholder = (string) ($props['emailPlaceholder'] ?? 'm@example.com');
@endphp

<div class="preview relative flex h-[420px] w-full items-start justify-center p-6">
    <x-ui.card class="w-full max-w-sm">
        <x-ui.card.header>
            <x-ui.card.title>{{ $title }}</x-ui.card.title>
            <x-ui.card.description>{{ $description }}</x-ui.card.description>
            <x-ui.card.action>
                <x-ui.button variant="link" size="sm">Sign Up</x-ui.button>
            </x-ui.card.action>
        </x-ui.card.header>

        <x-ui.card.content>
            <form>
                <div class="flex flex-col gap-4">
                    <div class="grid gap-2">
                        <x-ui.label for="preview-card-email">Email</x-ui.label>
                        <x-ui.input id="preview-card-email" type="email" :placeholder="$emailPlaceholder" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center">
                            <x-ui.label for="preview-card-password">Password</x-ui.label>
                            <a href="#" class="ml-auto inline-block text-sm underline-offset-4 hover:underline">Forgot your password?</a>
                        </div>
                        <x-ui.input id="preview-card-password" type="password" />
                    </div>
                </div>
            </form>
        </x-ui.card.content>

        <x-ui.card.footer class="flex-col gap-2">
            <x-ui.button type="button" class="w-full">Login</x-ui.button>
            <x-ui.button variant="outline" type="button" class="w-full">Login with Google</x-ui.button>
        </x-ui.card.footer>
    </x-ui.card>
</div>
