@props([
    'props' => [],
])

@php
    $default = (string) ($props['default'] ?? 'overview');
    $variant = (string) ($props['variant'] ?? 'underline');
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto w-full max-w-2xl">
        <x-ui.tabs.tabs :default="$default" :variant="$variant">
            <x-ui.tabs.list :variant="$variant">
                <x-ui.tabs.trigger tab="overview" :variant="$variant" icon="layout-grid">Overview</x-ui.tabs.trigger>
                <x-ui.tabs.trigger tab="activity" :variant="$variant" icon="activity">Activity</x-ui.tabs.trigger>
                <x-ui.tabs.trigger tab="settings" :variant="$variant" icon="settings">Settings</x-ui.tabs.trigger>
            </x-ui.tabs.list>

            <x-ui.tabs.content tab="overview">
                <div class="rounded-lg border border-border bg-card p-4 text-sm text-card-foreground">
                    Project overview with key metrics and latest highlights.
                </div>
            </x-ui.tabs.content>

            <x-ui.tabs.content tab="activity">
                <div class="rounded-lg border border-border bg-card p-4 text-sm text-card-foreground">
                    Recent activity stream from collaborators and system events.
                </div>
            </x-ui.tabs.content>

            <x-ui.tabs.content tab="settings">
                <div class="rounded-lg border border-border bg-card p-4 text-sm text-card-foreground">
                    Configuration panel for notifications and preferences.
                </div>
            </x-ui.tabs.content>
        </x-ui.tabs.tabs>
    </div>
</div>
