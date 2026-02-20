# Dropdown

Dropdowns display a list of actions or options in a compact menu, triggered by a button or interactive element.

## Installation

The dropdown component requires Alpine.js. Include Alpine in your layout:

```blade
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

## Usage

### Basic Dropdown

```blade
<x-ui.dropdown>
    <x-slot:trigger>
        <x-ui.button>
            Open Menu
            <x-icon.chevron-down class="w-4 h-4 ml-2" />
        </x-ui.button>
    </x-slot:trigger>

    <x-slot:content>
        <a href="#" class="block px-4 py-2 hover:bg-accent">Profile</a>
        <a href="#" class="block px-4 py-2 hover:bg-accent">Settings</a>
        <a href="#" class="block px-4 py-2 hover:bg-accent">Logout</a>
    </x-slot:content>
</x-ui.dropdown>
```

### Dropdown with Icon Trigger

```blade
<x-ui.dropdown align="end">
    <x-slot:trigger>
        <button class="p-2 hover:bg-accent rounded-md">
            <x-icon.more-vertical class="w-5 h-5" />
        </button>
    </x-slot:trigger>

    <x-slot:content>
        <button class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2">
            <x-icon.copy class="w-4 h-4" />
            Copy
        </button>
        <button class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2">
            <x-icon.edit class="w-4 h-4" />
            Edit
        </button>
        <button class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2 text-destructive">
            <x-icon.trash class="w-4 h-4" />
            Delete
        </button>
    </x-slot:content>
</x-ui.dropdown>
```

### Split Button

```blade
<div class="flex -space-x-px">
    <x-ui.button rounded-r="none">Save</x-ui.button>

    <x-ui.dropdown>
        <x-slot:trigger>
            <x-ui.button rounded-l="none" pill>
                <x-icon.chevron-down class="w-4 h-4" />
            </x-ui.button>
        </x-slot:trigger>

        <x-slot:content>
            <button class="w-full text-left px-4 py-2 hover:bg-accent">Save as Draft</button>
            <button class="w-full text-left px-4 py-2 hover:bg-accent">Save & Publish</button>
            <button class="w-full text-left px-4 py-2 hover:bg-accent">Save & Close</button>
        </x-slot:content>
    </x-ui.dropdown>
</div>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `align` | string | `'start'` | Horizontal alignment: `start`, `center`, `end` |
| `side` | string | `'bottom'` | Vertical side: `top`, `bottom` |
| `offset` | number | `4` | Distance from trigger in pixels |

## Examples

### User Menu

```blade
<x-ui.dropdown align="end">
    <x-slot:trigger>
        <button class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                <span class="text-sm font-medium">JD</span>
            </div>
            <x-icon.chevron-down class="w-4 h-4" />
        </button>
    </x-slot:trigger>

    <x-slot:content>
        <div class="px-4 py-2 border-b">
            <p class="font-medium">John Doe</p>
            <p class="text-sm text-muted-foreground">john@example.com</p>
        </div>

        <a href="/profile" class="block px-4 py-2 hover:bg-accent flex items-center gap-2">
            <x-icon.user class="w-4 h-4" />
            Profile
        </a>
        <a href="/settings" class="block px-4 py-2 hover:bg-accent flex items-center gap-2">
            <x-icon.settings class="w-4 h-4" />
            Settings
        </a>
        <a href="/billing" class="block px-4 py-2 hover:bg-accent flex items-center gap-2">
            <x-icon.credit-card class="w-4 h-4" />
            Billing
        </a>

        <div class="border-t my-1"></div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2 text-destructive">
                <x-icon.log-out class="w-4 h-4" />
                Logout
            </button>
        </form>
    </x-slot:content>
</x-ui.dropdown>
```

### Table Actions

```blade
<table>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <x-ui.dropdown align="end">
                        <x-slot:trigger>
                            <button class="p-2 hover:bg-accent rounded">
                                <x-icon.more-horizontal class="w-4 h-4" />
                            </button>
                        </x-slot:trigger>

                        <x-slot:content>
                            <a href="/users/{{ $user->id }}/edit" class="block px-4 py-2 hover:bg-accent">
                                Edit
                            </a>
                            <button wire:click="duplicate({{ $user->id }})" class="w-full text-left px-4 py-2 hover:bg-accent">
                                Duplicate
                            </button>
                            <div class="border-t my-1"></div>
                            <button wire:click="delete({{ $user->id }})" class="w-full text-left px-4 py-2 hover:bg-accent text-destructive">
                                Delete
                            </button>
                        </x-slot:content>
                    </x-ui.dropdown>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
```

### Share Menu

```blade
<x-ui.dropdown>
    <x-slot:trigger>
        <x-ui.button variant="outline" size="sm">
            <x-icon.share-2 class="w-4 h-4 mr-2" />
            Share
        </x-ui.button>
    </x-slot:trigger>

    <x-slot:content>
        <button wire:click="share('twitter')" class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <!-- Twitter icon -->
            </svg>
            Twitter
        </button>
        <button wire:click="share('facebook')" class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <!-- Facebook icon -->
            </svg>
            Facebook
        </button>
        <button wire:click="share('linkedin')" class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <!-- LinkedIn icon -->
            </svg>
            LinkedIn
        </button>
        <div class="border-t my-1"></div>
        <button wire:click="copyLink" class="w-full text-left px-4 py-2 hover:bg-accent flex items-center gap-2">
            <x-icon.link class="w-4 h-4" />
            Copy Link
        </button>
    </x-slot:content>
</x-ui.dropdown>
```

### Filter Dropdown

```blade
<x-ui.dropdown>
    <xslot:trigger>
        <x-ui.button variant="outline">
            <x-icon.filter class="w-4 h-4 mr-2" />
            Filter
        </x-ui.button>
    </x-slot:trigger>

    <x-slot:content>
        <div class="p-4 w-64">
            <h4 class="font-medium mb-4">Filters</h4>

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium">Status</label>
                    <div class="mt-2 space-y-1">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="filters.active" />
                            <span class="text-sm">Active</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="filters.inactive" />
                            <span class="text-sm">Inactive</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium">Date Range</label>
                    <x-ui.input type="date" class="mt-1" />
                </div>
            </div>

            <div class="flex gap-2 mt-4">
                <x-ui.button size="sm" variant="outline" wire:click="resetFilters">
                    Reset
                </x-ui.button>
                <x-ui.button size="sm" wire:click="applyFilters">
                    Apply
                </x-ui.button>
            </div>
        </div>
    </x-slot:content>
</x-ui.dropdown>
```

## Alpine.js Integration

The dropdown uses Alpine.js for state management:

```blade
<div x-data="{ open: false }">
    <!-- Trigger -->
    <button @click="open = !open" @click.away="open = false">
        Toggle Dropdown
    </button>

    <!-- Content -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
    >
        Dropdown content
    </div>
</div>
```

## Accessibility

Dropdowns include comprehensive accessibility features:

### ARIA Attributes

- `aria-haspopup="true"` on trigger
- `aria-expanded` indicates state
- `role="menu"` on content
- `role="menuitem"` on items
- Proper focus management

### Keyboard Navigation

- `Enter/Space` - Open menu
- `Escape` - Close menu
- `Arrow Down` - Next item
- `Arrow Up` - Previous item
- `Home` - First item
- `End` - Last item

## Styling

Customize dropdown styles:

```css
.dropdown-content {
    @apply z-50 min-w-[8rem] overflow-hidden rounded-md border bg-popover p-1;
    @apply text-popover-foreground shadow-md;
}

.dropdown-item {
    @apply relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5;
    @apply text-sm outline-none transition-colors;
}

.dropdown-item:hover {
    @apply bg-accent text-accent-foreground;
}

.dropdown-item:focus {
    @apply bg-accent text-accent-foreground;
}
```

## Best Practices

- Limit to 5-7 items for optimal UX
- Group related items with dividers
- Use destructive actions sparingly and place at bottom
- Provide clear labels for actions
- Consider alternatives for many options (dialog, full menu)
- Ensure keyboard accessibility

## Related Components

- [Button](/docs/components/button) - Triggers and actions
- [Menu](#) - Similar component for navigation
- [Popover](/docs/components/popover) - Custom content overlays
- [Tooltip](/docs/components/tooltip) - Hover information
