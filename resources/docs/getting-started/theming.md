# Theming

Velyx is built with theming in mind. Using CSS custom properties and Tailwind CSS v4, you can easily customize the look and feel of your entire application.

## Color System

Velyx uses the OKLCH color space for consistent, perceptually uniform colors across your interface.

### Semantic Color Tokens

The theme is built on semantic color tokens that serve specific purposes:

```css
:root {
    /* Base colors */
    --background: oklch(1 0 0);           /* Page background */
    --foreground: oklch(0.145 0 0);        /* Primary text */

    /* Component colors */
    --card: oklch(1 0 0);                  /* Card backgrounds */
    --card-foreground: oklch(0.145 0 0);   /* Card text */
    --popover: oklch(1 0 0);               /* Popover backgrounds */
    --popover-foreground: oklch(0.145 0 0);/* Popover text */

    /* Primary actions */
    --primary: oklch(0.205 0 0);          /* Primary buttons/links */
    --primary-foreground: oklch(0.985 0 0);/* Text on primary */

    /* Secondary elements */
    --secondary: oklch(0.97 0 0);          /* Secondary buttons */
    --secondary-foreground: oklch(0.205 0 0);

    /* Muted elements */
    --muted: oklch(0.97 0 0);              /* Muted backgrounds */
    --muted-foreground: oklch(0.556 0 0);  /* Muted text */

    /* Accents */
    --accent: oklch(0.97 0 0);             /* Accent backgrounds */
    --accent-foreground: oklch(0.205 0 0); /* Accent text */

    /* Destructive actions */
    --destructive: oklch(0.577 0.245 27.325);
    --destructive-foreground: oklch(1 0 0);

    /* Borders */
    --border: oklch(0.922 0 0);            /* Default borders */
    --input: oklch(0.922 0 0);             /* Input borders */
    --ring: oklch(0.708 0 0);              /* Focus rings */
}
```

## Dark Mode

Dark mode is automatically supported. Define your dark theme colors in the `.dark` class:

```css
.dark {
    --background: oklch(0.145 0 0);
    --foreground: oklch(0.985 0 0);
    --primary: oklch(0.922 0 0);
    --primary-foreground: oklch(0.205 0 0);
    /* ... override all tokens */
}
```

### Implementing Dark Mode Toggle

```blade
<button
    x-data="themeToggle"
    @click="toggleTheme"
    class="rounded-md p-2 hover:bg-accent"
>
    <svg class="h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
    </svg>
    <svg class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
</button>

<script>
function themeToggle() {
    return {
        init() {
            if (localStorage.getItem('theme') === 'dark' ||
                (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        },
        toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
    }
}
</script>
```

## Custom Colors

Create your own color scheme by modifying the CSS variables:

### Blue Theme

```css
:root {
    --primary: oklch(0.55 0.22 264);
    --primary-foreground: oklch(0.985 0 0);
    --accent: oklch(0.62 0.19 260);
}
```

### Purple Theme

```css
:root {
    --primary: oklch(0.55 0.22 285);
    --primary-foreground: oklch(0.985 0 0);
    --accent: oklch(0.62 0.19 280);
}
```

## Typography

Customize fonts using CSS variables:

```css
:root {
    --font-sans: "Inter", ui-sans-serif, sans-serif;
    --font-heading: "Cal Sans", ui-sans-serif, sans-serif;
    --font-mono: "JetBrains Mono", ui-monospace, monospace;
}
```

Apply in Tailwind:

```css
body {
    @apply font-sans bg-background text-foreground;
}

h1, h2, h3, h4, h5, h6 {
    @apply font-heading text-foreground;
}

code, pre {
    @apply font-mono;
}
```

## Border Radius

Customize corner rounding:

```css
:root {
    --radius: 0.5rem; /* Default */
}

/* More rounded */
.rounded-theme {
    border-radius: var(--radius);
}
```

## Spacing

While Tailwind provides utilities, you can define custom spacing scales:

```css
:root {
    --spacing: 0.25rem; /* Base unit */
}
```

## Shadows

Define custom shadow utilities:

```css
:root {
    --shadow-sm: 0 1px 3px 0px hsl(0 0% 0% / 0.1);
    --shadow: 0 1px 3px 0px hsl(0 0% 0% / 0.1);
    --shadow-md: 0 4px 6px -1px hsl(0 0% 0% / 0.1);
    --shadow-lg: 0 10px 15px -3px hsl(0 0% 0% / 0.1);
}
```

## Complete Theme Example

Here's a complete custom theme:

```css
:root {
    /* Colors */
    --background: oklch(0.98 0.01 85);
    --foreground: oklch(0.2 0.01 85);
    --primary: oklch(0.5 0.2 250);
    --primary-foreground: oklch(0.98 0 0);

    /* Typography */
    --font-sans: "Custom Font", sans-serif;
    --font-heading: "Custom Heading", serif;

    /* Spacing */
    --radius: 0.75rem;

    /* Effects */
    --shadow-md: 0 4px 12px hsl(250 50% 50% / 0.15);
}

.dark {
    --background: oklch(0.15 0.01 85);
    --foreground: oklch(0.95 0.01 85);
    --primary: oklch(0.7 0.2 250);
    --primary-foreground: oklch(0.1 0 0);
}
```

## Using Tailwind's Theme Extension

For more advanced theming, extend Tailwind's theme:

```js
// tailwind.config.js
export default {
  theme: {
    extend: {
      colors: {
        brand: {
          50: 'oklch(0.95 0.05 250)',
          100: 'oklch(0.9 0.1 250)',
          // ... more shades
        }
      }
    }
  }
}
```

## Best Practices

1. **Use semantic tokens** - Name colors by purpose, not appearance
2. **Maintain contrast** - Ensure WCAG AA compliance (4.5:1 for text)
3. **Test both themes** - Verify light and dark modes work
4. **Keep it simple** - Start with defaults, then customize incrementally
5. **Document changes** - Note any custom tokens for your team
