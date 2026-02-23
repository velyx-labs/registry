# Badge

Badges are small status indicators for labeling and categorization.

## Installation

The badge component is available at `resources/views/components/ui/badge.blade.php`.

## Usage

### Basic Badge

```php
<x-ui.badge>Default</x-ui.badge>
```

### Variants

```php
<x-ui.badge variant="default">Default</x-ui.badge>
<x-ui.badge variant="primary">Primary</x-ui.badge>
<x-ui.badge variant="secondary">Secondary</x-ui.badge>
<x-ui.badge variant="destructive">Destructive</x-ui.badge>
<x-ui.badge variant="outline">Outline</x-ui.badge>
```

### With Icons

```php
<x-ui.badge>
    <x-icon.check class="w-3 h-3 mr-1" />
    Verified
</x-ui.badge>
```

### Sizes

```php
<x-ui.badge size="sm">Small</x-ui.badge>
<x-ui.badge>Default</x-ui.badge>
<x-ui.badge size="lg">Large</x-ui.badge>
```

### Rounded/Pill

```php
<x-ui.badge pill>Pill Badge</x-ui.badge>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | string | `'default'` | Visual style: `default`, `primary`, `secondary`, `destructive`, `outline` |
| `size` | string | `'default'` | Size: `sm`, `default`, `lg` |
| `pill` | bool | `false` | Fully rounded corners |

## Examples

### Status Indicators

```php
<div class="space-x-2">
    <x-ui.badge variant="destructive">Error</x-ui.badge>
    <x-ui.badge variant="default">Pending</x-ui.badge>
    <x-ui.badge variant="primary">Active</x-ui.badge>
    <x-ui.badge variant="outline">Archived</x-ui.badge>
</div>
```

### User Status

```php
<div class="flex items-center gap-2">
    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
        <span class="text-sm font-medium">JD</span>
    </div>
    <div>
        <p class="font-medium">John Doe</p>
        <x-ui.badge size="sm" variant="primary">Online</x-ui.badge>
    </div>
</div>
```

### Notification Badge

```php
<div class="relative">
    <x-icon.bell class="w-6 h-6" />
    <x-ui.badge
        variant="destructive"
        pill
        class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center p-0 text-xs"
    >
        3
    </x-ui.badge>
</div>
```

### Feature Tags

```php
<div class="space-y-4">
    <h3 class="font-semibold">Features</h3>
    <div class="flex flex-wrap gap-2">
        <x-ui.badge variant="outline">Real-time</x-ui.badge>
        <x-ui.badge variant="outline">Secure</x-ui.badge>
        <x-ui.badge variant="outline">Scalable</x-ui.badge>
        <x-ui.badge variant="outline">Fast</x-ui.badge>
    </div>
</div>
```

### Pricing Plans

```php
<div class="border rounded-lg p-6">
    <div class="flex items-start justify-between mb-4">
        <div>
            <h3 class="text-lg font-semibold">Pro Plan</h-ui.badge>
            <x-ui.badge variant="primary" size="sm">Popular</x-ui.badge>
        </div>
        <p class="text-2xl font-bold">$29<span class="text-sm font-normal text-muted-foreground">/mo</span></p>
    </div>
    <!-- Plan details -->
</div>
```

### Version Numbers

```php
<div class="flex items-center gap-2">
    <span class="font-semibold">Velyx</span>
    <x-ui.badge variant="secondary" size="sm">v1.0.0</x-ui.badge>
    <x-ui.badge variant="outline" size="sm">Stable</x-ui.badge>
</div>
```

### Count Statistics

```php
<div class="grid grid-cols-3 gap-4">
    <div class="text-center">
        <x-ui.badge variant="primary" size="lg" class="mb-2">1,234</x-ui.badge>
        <p class="text-sm text-muted-foreground">Users</p>
    </div>
    <div class="text-center">
        <x-ui.badge variant="secondary" size="lg" class="mb-2">567</x-ui.badge>
        <p class="text-sm text-muted-foreground">Projects</p>
    </div>
    <div class="text-center">
        <x-ui.badge variant="destructive" size="lg" class="mb-2">89</x-ui.badge>
        <p class="text-sm text-muted-foreground">Errors</p>
    </div>
</div>
```

### With Links

```php
<a href="/docs">
    <x-ui.badge variant="outline" class="hover:bg-accent cursor-pointer">
        Documentation
        <x-icon.arrow-right class="w-3 h-3 ml-1" />
    </x-ui.badge>
</a>
```

## Status Colors

Create custom status badges:

```php
<!-- Success -->
<x-ui.badge class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
    Success
</x-ui.badge>

<!-- Warning -->
<x-ui.badge class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
    Warning
</x-ui.badge>

<!-- Info -->
<x-ui.badge class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
    Info
</x-ui.badge>
```

## Styling

Customize badge styles:

```css
.badge {
    @apply inline-flex items-center rounded-full border;
    @apply px-2.5 py-0.5 text-xs font-semibold;
    @apply transition-colors focus:outline-none;
}

.badge-sm {
    @apply px-2 py-0 text-xs;
}

.badge-lg {
    @apply px-3 py-1 text-sm;
}

.badge-pill {
    @apply rounded-full;
}
```

## Accessibility

Badges should be used for supplemental information:

```php
<!-- Good - supplement content -->
<div>
    <span>Status: </span>
    <x-ui.badge>Active</x-ui.badge>
</div>

<!-- Avoid - badge as only content -->
<x-ui.badge>Active</x-ui.badge> <!-- Missing context -->

<!-- Better - include text -->
<div>
    <span class="sr-only">Account status:</span>
    <x-ui.badge>Active</x-ui.badge>
</div>
```

## Best Practices

- Use for status, categories, and counts
- Keep text short (1-2 words)
- Ensure sufficient color contrast
- Provide context when badges are color-coded
- Don't rely on color alone - use text labels
- Limit to 3-7 badges in a grouping

## Related Components

- [Button](/docs/components/button) - Actions
- [Alert](/docs/components/alert) - Important messages
- [Avatar](/docs/components/avatar) - User representations
- [Tag](#) - Similar component for categorization
