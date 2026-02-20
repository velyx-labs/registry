# Tabs

Tabs organize content into separate panels, allowing users to switch between different views or datasets.

## Installation

The tabs component requires Alpine.js. Include Alpine in your layout:

```blade
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

## Usage

### Basic Tabs

```blade
<x-ui.tabs>
    <x-ui.tabs.list>
        <x-ui.tabs.trigger value="overview">Overview</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="features">Features</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="pricing">Pricing</x-ui.tabs.trigger>
    </x-ui.tabs.list>

    <x-ui.tabs.content value="overview">
        <p>This is the overview content...</p>
    </x-ui.tabs.content>

    <x-ui.tabs.content value="features">
        <p>This is the features content...</p>
    </x-ui.tabs.content>

    <x-ui.tabs.content value="pricing">
        <p>This is the pricing content...</p>
    </x-ui.tabs.content>
</x-ui.tabs>
```

### With Icons

```blade
<x-ui.tabs>
    <x-ui.tabs.list>
        <x-ui.tabs.trigger value="home">
            <x-icon.house class="w-4 h-4 mr-2" />
            Home
        </x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="profile">
            <x-icon.user class="w-4 h-4 mr-2" />
            Profile
        </x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="settings">
            <x-icon.settings class="w-4 h-4 mr-2" />
            Settings
        </x-ui.tabs.trigger>
    </x-ui.tabs.list>

    <x-ui.tabs.content value="home">
        <!-- Home content -->
    </x-ui.tabs.content>

    <x-ui.tabs.content value="profile">
        <!-- Profile content -->
    </x-ui.tabs.content>

    <x-ui.tabs.content value="settings">
        <!-- Settings content -->
    </x-ui.tabs.content>
</x-ui.tabs>
```

### Vertical Tabs

```blade
<div class="flex gap-4">
    <x-ui.tabs orientation="vertical" class="w-48">
        <x-ui.tabs.list>
            <x-ui.tabs.trigger value="tab1">Tab 1</x-ui.tabs.trigger>
            <x-ui.tabs.trigger value="tab2">Tab 2</x-ui.tabs.trigger>
            <x-ui.tabs.trigger value="tab3">Tab 3</x-ui.tabs.trigger>
        </x-ui.tabs.list>

        <x-ui.tabs.content value="tab1">Content 1</x-ui.tabs.content>
        <x-ui.tabs.content value="tab2">Content 2</x-ui.tabs.content>
        <x-ui.tabs.content value="tab3">Content 3</x-ui.tabs.content>
    </x-ui.tabs>
</div>
```

### Default Active Tab

```blade
<x-ui.tabs default-value="features">
    <!-- ... -->
</x-ui.tabs>
```

## Props

### Tabs Container

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `defaultValue` | string | `null` | Initially active tab value |
| `orientation` | string | `'horizontal'` | Layout: `horizontal` or `vertical` |

### Tabs Trigger

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `value` | string | *required* | Unique identifier for tab |
| `disabled` | bool | `false` | Disable tab interaction |

### Tabs Content

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `value` | string | *required* | Matches trigger value |

## Examples

### Product Details

```blade
<x-ui.tabs>
    <x-ui.tabs.list>
        <x-ui.tabs.trigger value="description">Description</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="specifications">Specifications</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="reviews">Reviews</x-ui.tabs.trigger>
    </x-ui.tabs.list>

    <x-ui.tabs.content value="description">
        <h3 class="text-lg font-semibold mb-2">Product Description</h3>
        <p class="text-muted-foreground">
            This is a high-quality product designed for...
        </p>
    </x-ui.tabs.content>

    <x-ui.tabs.content value="specifications">
        <dl class="space-y-2">
            <div class="flex justify-between">
                <dt class="font-medium">Weight</dt>
                <dd class="text-muted-foreground">1.5 kg</dd>
            </div>
            <div class="flex justify-between">
                <dt class="font-medium">Dimensions</dt>
                <dd class="text-muted-foreground">30 x 20 x 10 cm</dd>
            </div>
        </dl>
    </x-ui.tabs.content>

    <x-ui.tabs.content value="reviews">
        <div class="space-y-4">
            @foreach($reviews as $review)
                <div class="border-b pb-4">
                    <p class="font-medium">{{ $review->author }}</p>
                    <p class="text-muted-foreground">{{ $review->text }}</p>
                </div>
            @endforeach
        </div>
    </x-ui.tabs.content>
</x-ui.tabs>
```

### Settings Panel

```blade
<div class="max-w-2xl">
    <h2 class="text-2xl font-bold mb-6">Settings</h2>

    <x-ui.tabs>
        <x-ui.tabs.list>
            <x-ui.tabs.trigger value="general">General</x-ui.tabs.trigger>
            <x-ui.tabs.trigger value="notifications">Notifications</x-ui.tabs.trigger>
            <x-ui.tabs.trigger value="security">Security</x-ui.tabs.trigger>
            <x-ui.tabs.trigger value="billing">Billing</x-ui.tabs.trigger>
        </x-ui.tabs.list>

        <x-ui.tabs.content value="general">
            <form class="space-y-4">
                <div>
                    <x-ui.label for="name">Name</x-ui.label>
                    <x-ui.input id="name" type="text" value="John Doe" />
                </div>
                <div>
                    <x-ui.label for="email">Email</x-ui.label>
                    <x-ui.input id="email" type="email" value="john@example.com" />
                </div>
                <x-ui.button type="submit">Save Changes</x-ui.button>
            </form>
        </x-ui.tabs.content>

        <x-ui.tabs.content value="notifications">
            <div class="space-y-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" checked />
                    Email notifications
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" checked />
                    Push notifications
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" />
                    SMS notifications
                </label>
            </div>
        </x-ui.tabs.content>

        <x-ui.tabs.content value="security">
            <div class="space-y-4">
                <div>
                    <x-ui.label>Current Password</x-ui.label>
                    <x-ui.input type="password" />
                </div>
                <div>
                    <x-ui.label>New Password</x-ui.label>
                    <x-ui.input type="password" />
                </div>
                <x-ui.button variant="primary">Update Password</x-ui.button>
            </div>
        </x-ui.tabs.content>

        <x-ui.tabs.content value="billing">
            <p class="text-muted-foreground">Billing information and history...</p>
        </x-ui.tabs.content>
    </x-ui.tabs>
</div>
```

### Code Examples

```blade
<x-ui.tabs>
    <x-ui.tabs.list>
        <x-ui.tabs.trigger value="php">PHP</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="javascript">JavaScript</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="python">Python</x-ui.tabs.trigger>
    </x-ui.tabs.list>

    <x-ui.tabs.content value="php">
        <pre><code>{{ $phpExample }}</code></pre>
    </x-ui.tabs.content>

    <x-ui.tabs.content value="javascript">
        <pre><code>{{ $jsExample }}</code></pre>
    </x-ui.tabs.content>

    <x-ui.tabs.content value="python">
        <pre><code>{{ $pythonExample }}</code></pre>
    </x-ui.tabs.content>
</x-ui.tabs>
```

## Alpine.js Integration

The tabs component uses Alpine.js for state management:

```js
document.addEventListener('alpine:init', () => {
    Alpine.data('tabs', (defaultValue = null) => ({
        activeTab: defaultValue || null,

        setActive(value) {
            this.activeTab = value;
        },

        isActive(value) {
            return this.activeTab === value;
        }
    }));
});
```

## Accessibility

Tabs include comprehensive accessibility features:

### ARIA Attributes

- `role="tablist"` on container
- `role="tab"` on triggers
- `role="tabpanel"` on content panels
- `aria-selected` indicates active tab
- `aria-controls` links tab to panel
- `aria-labelledby` references controlling tab

### Keyboard Navigation

- `Arrow Right/Down` - Next tab
- `Arrow Left/Up` - Previous tab
- `Home` - First tab
- `End` - Last tab
- `Enter/Space` - Activate tab

## Styling

Customize tab appearance:

```css
[data-orientation="horizontal"] .tabs-list {
    @apply inline-flex h-10 items-center justify-center rounded-md bg-muted p-1;
}

.tabs-trigger {
    @apply inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5;
    @apply text-sm font-medium ring-offset-background;
    @apply transition-all focus-visible:outline-none focus-visible:ring-2;
    @apply disabled:pointer-events-none disabled:opacity-50;
}

.tabs-trigger[data-state="active"] {
    @apply bg-background text-foreground shadow-sm;
}

.tabs-content {
    @apply mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2;
}
```

## Best Practices

- Keep tab labels short and descriptive
- Use 3-7 tabs for optimal UX
- Consider alternatives (dropdown, accordion) for many tabs
- Maintain consistent content structure across tabs
- Preserve tab state when navigating away and back

## Related Components

- [Accordion](/docs/components/accordion) - Vertical content organization
- [Dropdown](/docs/components/dropdown) - Menu interactions
- [Stepper](/docs/components/stepper) - Multi-step flows
