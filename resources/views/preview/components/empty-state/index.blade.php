@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded-lg border border-border p-4">
            <x-ui.empty-state
                title="No projects yet"
                description="Create your first project to start collaborating with your team."
                icon="folder-open"
                action-label="Create project"
                action-url="#"
            />
        </div>

        <div class="rounded-lg border border-border p-4">
            <x-ui.empty-state
                title="No notifications"
                description="You are all caught up for now."
                icon="bell-off"
                variant="ghost"
                size="sm"
            />
        </div>
    </div>
</div>
