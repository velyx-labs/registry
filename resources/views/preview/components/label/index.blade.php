@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="mx-auto grid w-full max-w-xl gap-6">
        <div class="grid gap-2">
            <x-ui.label for="email" required="true" description="We will only use this email for account-related updates.">
                Email address
            </x-ui.label>
            <x-ui.input id="email" type="email" placeholder="name@example.com" class="w-full" />
        </div>

        <div class="grid gap-2">
            <x-ui.label for="project-name">Project name</x-ui.label>
            <x-ui.input id="project-name" type="text" placeholder="Acme Platform" class="w-full" />
        </div>
    </div>
</div>
