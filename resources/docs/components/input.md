# Input

Input fields allow users to enter and edit text content.

## Installation

The input component is available at `resources/views/components/ui/input.blade.php`.

## Usage

### Basic Input

```blade
<x-ui.input type="text" placeholder="Enter your name" />
```

### With Label

```blade
<div>
    <x-ui.label for="email">Email</x-ui.label>
    <x-ui.input id="email" type="email" placeholder="you@example.com" />
</div>
```

### Input Types

```blade
<!-- Text -->
<x-ui.input type="text" />

<!-- Email -->
<x-ui.input type="email" />

<!-- Password -->
<x-ui.input type="password" />

<!-- Number -->
<x-ui.input type="number" />

<!-- Tel -->
<x-ui.input type="tel" />

<!-- URL -->
<x-ui.input type="url" />

<!-- Date -->
<x-ui.input type="date" />

<!-- Time -->
<x-ui.input type="time" />
```

### With Livewire

```blade
<x-ui.input
    type="text"
    wire:model="name"
    placeholder="Enter your name"
/>
```

### Disabled State

```blade
<x-ui.input disabled placeholder="Disabled input" />
```

### With Helper Text

```blade
<div>
    <x-ui.label for="password">Password</x-ui.label>
    <x-ui.input id="password" type="password" />
    <p class="text-sm text-muted-foreground mt-1">
        Must be at least 8 characters
    </p>
</div>
```

### With Error State

```blade
<div>
    <x-ui.label for="email">Email</x-ui.label>
    <x-ui.input
        id="email"
        type="email"
        class="{{ $errors->has('email') ? 'border-destructive' : '' }}"
    />
    @error('email')
        <p class="text-sm text-destructive mt-1">{{ $message }}</p>
    @enderror
</div>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | string | `'text'` | Input type |
| `id` | string | `null` | Unique identifier |
| `name` | string | `null` | Form field name |
| `value` | string | `null` | Initial value |
| `placeholder` | string | `null` | Placeholder text |
| `disabled` | bool | `false` | Disabled state |
| `readonly` | bool | `false` | Read-only state |
| `required` | bool | `false` | Required field |

## Examples

### Search Input

```blade
<div class="relative">
    <x-ui.input
        type="search"
        placeholder="Search..."
        class="pl-10"
    />
    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground">
        <!-- Search icon -->
    </svg>
</div>
```

### Input with Icon

```blade
<div class="relative">
    <x-ui.input type="text" class="pr-10" placeholder="Username" />
    <div class="absolute right-3 top-1/2 -translate-y-1/2">
        <x-icon.at-sign class="h-4 w-4 text-muted-foreground" />
    </div>
</div>
```

### Form Group

```blade
<div class="space-y-4">
    <div>
        <x-ui.label for="first-name">First Name</x-ui.label>
        <x-ui.input id="first-name" type="text" />
    </div>

    <div>
        <x-ui.label for="last-name">Last Name</x-ui.label>
        <x-ui.input id="last-name" type="text" />
    </div>

    <div>
        <x-ui.label for="email">Email</x-ui.label>
        <x-ui.input id="email" type="email" />
    </div>
</div>
```

## Accessibility

Inputs include built-in accessibility features:

### Proper Labeling

```blade
<label for="username">Username</label>
<input id="username" type="text" aria-required="true">
```

### Error Announcements

```blade
<input
    id="email"
    type="email"
    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
    aria-describedby="email-error"
>
<p id="email-error" role="alert" class="text-destructive">
    {{ $errors->first('email') }}
</p>
```

### Descriptive Help

```blade
<input
    id="password"
    type="password"
    aria-describedby="password-requirements"
>
<p id="password-requirements">
    Must be at least 8 characters with uppercase and lowercase letters
</p>
```

## Validation

Use Laravel's validation with inputs:

```php
// In your Livewire component
#[Validate('required|email')]
public string $email = '';

#[Validate('required|min:8')]
public string $password = '';
```

```blade
// In your view
<x-ui.input
    wire:model="email"
    type="email"
    class="{{ $errors->has('email') ? 'border-destructive' : '' }}"
/>
```

## Styling

Customize input styles:

```css
input {
    @apply flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background;
    @apply file:border-0 file:bg-transparent file:text-sm file:font-medium;
    @apply placeholder:text-muted-foreground;
    @apply focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2;
    @apply disabled:cursor-not-allowed disabled:opacity-50;
}
```

## Related Components

- [Label](/docs/components/label) - Form labels
- [Toggle](/docs/components/toggle) - Switch inputs
- [File Upload](/docs/components/file-upload) - File inputs
- [Date Picker](/docs/components/date-picker) - Date selection
