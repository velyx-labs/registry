@props([
    'props' => [],
])

@php
    $data = [400, 300, 200, 300, 200, 278, 189, 239, 300, 200, 278, 189, 349];
@endphp

<div class="preview w-full p-6" x-data="{ goal: 350, data: @js($data), adjust(v) { this.goal = Math.max(200, Math.min(400, this.goal + v)); } }">
    <x-ui.drawer id="goal-drawer">
        <x-ui.drawer.trigger as-child="true" target="goal-drawer">
            <x-ui.button variant="outline">Open Drawer</x-ui.button>
        </x-ui.drawer.trigger>

        <x-ui.drawer.content>
            <div class="mx-auto w-full max-w-sm">
                <x-ui.drawer.header>
                    <x-ui.drawer.title>Move Goal</x-ui.drawer.title>
                    <x-ui.drawer.description>Set your daily activity goal.</x-ui.drawer.description>
                </x-ui.drawer.header>

                <div class="p-4 pb-0">
                    <div class="flex items-center justify-center space-x-2">
                        <x-ui.button
                            variant="outline"
                            size="icon"
                            class="h-8 w-8 shrink-0 rounded-full"
                            @click="adjust(-10)"
                            x-bind:disabled="goal <= 200"
                        >
                            <x-lucide-minus class="size-4" />
                            <span class="sr-only">Decrease</span>
                        </x-ui.button>

                        <div class="flex-1 text-center">
                            <div class="text-7xl font-bold tracking-tighter" x-text="goal"></div>
                            <div class="text-muted-foreground text-[0.70rem] uppercase">Calories/day</div>
                        </div>

                        <x-ui.button
                            variant="outline"
                            size="icon"
                            class="h-8 w-8 shrink-0 rounded-full"
                            @click="adjust(10)"
                            x-bind:disabled="goal >= 400"
                        >
                            <x-lucide-plus class="size-4" />
                            <span class="sr-only">Increase</span>
                        </x-ui.button>
                    </div>

                    <div class="mt-3 h-[120px] rounded-lg border border-border p-2">
                        <div class="flex h-full items-end gap-1">
                            <template x-for="(value, index) in data" :key="index">
                                <div class="bg-primary/80 w-full rounded-sm" :style="`height: ${Math.max(8, Math.round(value / 4))}px`"></div>
                            </template>
                        </div>
                    </div>
                </div>

                <x-ui.drawer.footer>
                    <x-ui.button>Submit</x-ui.button>
                    <x-ui.drawer.close as-child="true" target="goal-drawer">
                        <x-ui.button variant="outline">Cancel</x-ui.button>
                    </x-ui.drawer.close>
                </x-ui.drawer.footer>
            </div>
        </x-ui.drawer.content>
    </x-ui.drawer>
</div>
