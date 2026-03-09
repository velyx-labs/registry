@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <x-ui.dropdown>
        <x-ui.dropdown.trigger as-child="true">
            <x-ui.button variant="outline">Open</x-ui.button>
        </x-ui.dropdown.trigger>

        <x-ui.dropdown.content class="w-40" align="start">
            <x-ui.dropdown.group>
                <x-ui.dropdown.label>My Account</x-ui.dropdown.label>
                <x-ui.dropdown.item>
                    Profile
                    <x-ui.dropdown.shortcut>⇧⌘P</x-ui.dropdown.shortcut>
                </x-ui.dropdown.item>
                <x-ui.dropdown.item>
                    Billing
                    <x-ui.dropdown.shortcut>⌘B</x-ui.dropdown.shortcut>
                </x-ui.dropdown.item>
                <x-ui.dropdown.item>
                    Settings
                    <x-ui.dropdown.shortcut>⌘S</x-ui.dropdown.shortcut>
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>

            <x-ui.dropdown.separator />

            <x-ui.dropdown.group>
                <x-ui.dropdown.item>Team</x-ui.dropdown.item>
                <x-ui.dropdown.sub>
                    <x-ui.dropdown.sub-trigger>Invite users</x-ui.dropdown.sub-trigger>
                    <x-ui.dropdown.portal>
                        <x-ui.dropdown.sub-content>
                            <x-ui.dropdown.item>Email</x-ui.dropdown.item>
                            <x-ui.dropdown.item>Message</x-ui.dropdown.item>
                            <x-ui.dropdown.separator />
                            <x-ui.dropdown.item>More...</x-ui.dropdown.item>
                        </x-ui.dropdown.sub-content>
                    </x-ui.dropdown.portal>
                </x-ui.dropdown.sub>
                <x-ui.dropdown.item>
                    New Team
                    <x-ui.dropdown.shortcut>⌘+T</x-ui.dropdown.shortcut>
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>

            <x-ui.dropdown.separator />

            <x-ui.dropdown.group>
                <x-ui.dropdown.item>GitHub</x-ui.dropdown.item>
                <x-ui.dropdown.item>Support</x-ui.dropdown.item>
                <x-ui.dropdown.item :disabled="true">API</x-ui.dropdown.item>
            </x-ui.dropdown.group>

            <x-ui.dropdown.separator />

            <x-ui.dropdown.group>
                <x-ui.dropdown.item>
                    Log out
                    <x-ui.dropdown.shortcut>⇧⌘Q</x-ui.dropdown.shortcut>
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>
        </x-ui.dropdown.content>
    </x-ui.dropdown>
</div>
