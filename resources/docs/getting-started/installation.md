# Installation

Get started with Velyx in your Laravel project with a few simple steps.

## Requirements

- PHP 8.2 or higher
- Laravel 11 or higher
- Composer
- Node.js 18+ and NPM/PNPM

## Step 1: Install Dependencies

Install the required Laravel packages:

```bash
composer require livewire/livewire mallardduck/blade-lucide-icons
```

Install the NPM dependencies:

```bash
pnpm add tailwindcss @tailwindcss/forms @tailwindcss/typography alpinejs
```

## Step 2: Configure Tailwind CSS

Velyx uses Tailwind CSS v4. Ensure your `tailwind.config.js` is properly configured:

```js
export default {
  content: [
    './resources/views/**/*.blade.php',
    './vendor/livewire/livewire/src/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
```

## Step 3: Set Up Alpine.js

In your `resources/js/app.js`, initialize Alpine.js:

```js
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()
```

## Step 4: Publish Components

Copy the Velyx components to your project:

```bash
# If using Velyx CLI
velyx add button
velyx add input
velyx add modal

# Or copy all components at once
cp -r registry/components/* resources/views/components/ui/
```

## Step 5: Configure Theme Variables

Add the theme CSS variables to your `resources/css/app.css`:

```css
@import "tailwindcss";

@source '../views';
@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';

@custom-variant dark (&:is(.dark *));

:root {
    --background: oklch(1 0 0);
    --foreground: oklch(0.145 0 0);
    --primary: oklch(0.205 0 0);
    --primary-foreground: oklch(0.985 0 0);
    /* ... more variables */
}

.dark {
    --background: oklch(0.145 0 0);
    --foreground: oklch(0.985 0 0);
    /* ... more variables */
}
```

## Step 6: Initialize Livewire

In your `bootstrap/app.php`, register Livewire:

```php
use Livewire\Livewire;

// ...

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
```

Add this to your layout file:

```php
@livewireStyles
</head>
<body>
    {{ $slot }}
    @livewireScripts
</body>
```

## What's Next?

Now that Velyx is installed, check out:
- [Theming](/docs/theming) - Customize colors and styles
- [Components](/docs/components/button) - Browse available components
- [Accessibility](/docs/accessibility) - Learn about a11y features

## Troubleshooting

### Components not rendering?

Make sure you've:
1. Cleared your view cache: `php artisan view:clear`
2. Compiled assets: `pnpm run build` or `pnpm run dev`
3. Published the Livewire views: `php artisan livewire:publish --config`

### Styles not applying?

Run:
```bash
php artisan view:clear
pnpm run dev
```

### Dark mode not working?

Ensure you have the theme initialization script in your layout:

```js
if (localStorage.getItem('theme') === 'dark' ||
    (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}
```
