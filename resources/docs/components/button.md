# Button

Buttons allow users to perform actions and make choices. They're used to trigger events, navigate pages, or submit forms.

## Installation

The button component is available as a Blade component at `resources/views/components/ui/button.blade.php`.

## Usage

### Basic Button

```php
<x-ui.button>Click me</x-ui.button>
```

### Variants

Choose from multiple visual styles:

```php
<x-ui.button variant="primary">Primary</x-ui.button>
<x-ui.button variant="secondary">Secondary</x-ui.button>
<x-ui.button variant="outline">Outline</x-ui.button>
<x-ui.button variant="ghost">Ghost</x-ui.button>
<x-ui.button variant="link">Link</x-ui.button>
<x-ui.button variant="destructive">Destructive</x-ui.button>
```

### Sizes

Control the button size:

```php
<x-ui.button size="xs">Extra Small</x-ui.button>
<x-ui.button size="sm">Small</x-ui.button>
<x-ui.button size="md">Medium</x-ui.button>
<x-ui.button size="lg">Large</x-ui.button>
<x-ui.button size="xl">Extra Large</x-ui.button>
```

### With Icons

Add icons to buttons:

```php
<!-- Left icon -->
<x-ui.button icon="save">Save</x-ui.button>

<!-- Right icon -->
<x-ui.button iconRight="arrow-right">Continue</x-ui.button>

<!-- Icon only -->
<x-ui.button icon="settings" iconOnly="true" title="Settings" />
```

### Pill Shape

Make buttons fully rounded:

```php
<x-ui.button pill>Sign Up</x-ui.button>
```

### Block/Full Width

Full-width buttons for mobile:

```php
<x-ui.button block>Full Width</x-ui.button>
```

### As Link

Render as an anchor tag:

```php
<x-ui.button href="/docs" variant="outline">
  Read Docs
</x-ui.button>
```

### Disabled State

```php
<x-ui.button disabled>Disabled</x-ui.button>
```

### Loading State

Works with Livewire loading states:

```php
<x-ui.button action="save">
  Save Changes
</x-ui.button>

<!-- Manual loading -->
<x-ui.button loading="true">
  Processing...
</x-ui.button>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | string | `'primary'` | Visual style: `primary`, `secondary`, `outline`, `ghost`, `link`, `destructive` |
| `size` | string | `'md'` | Size: `xs`, `sm`, `md`, `lg`, `xl` |
| `icon` | string | `null` | Lucide icon name (left side) |
| `iconRight` | string | `null` | Lucide icon name (right side) |
| `iconOnly` | bool | `false` | Show only the icon |
| `pill` | bool | `false` | Fully rounded corners |
| `block` | bool | `false` | Full width |
| `href` | string | `null` | Render as link instead of button |
| `type` | string | `'button'` | Button type: `button`, `submit`, `reset` |
| `disabled` | bool | `false` | Disabled state |
| `loading` | bool | `false` | Show loading spinner |
| `action` | string | `null` | Livewire action name for loading state |

## Examples

### Button Group

```php
<div class="flex gap-2">
  <x-ui.button>Cancel</x-ui.button>
  <x-ui.button variant="primary">Confirm</x-ui.button>
</div>
```

### Icon Actions

```php
<div class="flex gap-2">
  <x-ui.button variant="ghost" icon="edit" iconOnly size="sm" title="Edit" />
  <x-ui.button variant="ghost" icon="trash-2" iconOnly size="sm" title="Delete" />
  <x-ui.button variant="ghost" icon="more-vertical" iconOnly size="sm" title="More" />
</div>
```

### Confirmation Actions

```php
<div class="flex items-center justify-between p-4 border rounded-lg">
  <div>
    <h3 class="font-semibold">Delete account?</h3>
    <p class="text-sm text-muted-foreground">This action cannot be undone.</p>
  </div>
  <div class="flex gap-2">
    <x-ui.button variant="outline">Cancel</x-ui.button>
    <x-ui.button variant="destructive">Delete</x-ui.button>
  </div>
</div>
```

## Accessibility

Buttons include proper ARIA attributes:

- `aria-disabled` for disabled buttons
- Screen reader text for icon-only buttons
- Proper focus indicators
- Keyboard support (Enter/Space to activate)

### Best Practices

- Use descriptive button text
- Provide `title` attribute for icon-only buttons
- Don't use buttons for navigation (use links instead)
- Group related buttons logically

## Styling

Customize button styles using CSS variables:

```css
:root {
    --primary: oklch(0.5 0.2 250);
    --primary-foreground: oklch(0.98 0 0);
}
```

## Related Components

- [Badge](/docs/components/badge) - Status indicators
- [Dropdown](/docs/components/dropdown) - Action menus
- [Toggle](/docs/components/toggle) - Switch inputs
