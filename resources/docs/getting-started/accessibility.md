# Accessibility

Velyx is committed to building inclusive interfaces that work for everyone. All components follow WAI-ARIA authoring practices and WCAG 2.1 guidelines.

## Our Commitment

### WCAG 2.1 Level AA

All Velyx components aim to meet WCAG 2.1 Level AA requirements, including:

- **Perceivable**: Information and UI components must be presentable in ways users can perceive
- **Operable**: UI components and navigation must be operable
- **Understandable**: Information and the operation of the UI must be understandable
- **Robust**: Content must be robust enough to be interpreted by a wide variety of user agents

## Keyboard Navigation

All interactive components are fully keyboard accessible:

### Standard Keyboard Patterns

| Key | Action |
|-----|--------|
| `Tab` | Move focus to next interactive element |
| `Shift + Tab` | Move focus to previous element |
| `Enter` / `Space` | Activate buttons, toggle switches |
| `Escape` | Close modals, drawers, dropdowns |
| `Arrow Keys` | Navigate within components (tabs, lists) |
| `Home` / `End` | Jump to start/end of list |

### Focus Management

Components automatically manage focus for better UX:

```php
<!-- Focus is trapped in modal -->
<dialog>
  <form method="dialog">
    <button>Cancel</button>
    <button autofocus>Confirm</button>
  </form>
</dialog>
```

## ARIA Attributes

Velyx components use semantic ARIA attributes:

### Roles

```php
<!-- Accordion with proper roles -->
<div role="region" aria-labelledby="accordion-heading">
  <button aria-expanded="true" aria-controls="panel-1">
    Section 1
  </button>
  <div id="panel-1" role="region" aria-labelledby="button-1">
    Content
  </div>
</div>
```

### Labels

```php
<!-- Proper form labeling -->
<label for="email">Email address</label>
<input
  id="email"
  type="email"
  required
  aria-invalid="false"
  aria-describedby="email-hint"
>
<p id="email-hint" class="text-sm">We'll never share your email.</p>
```

### Live Regions

```php
<!-- Toast announcements -->
<div
  role="status"
  aria-live="polite"
  aria-atomic="true"
>
  File uploaded successfully
</div>
```

## Screen Reader Support

All components provide screen reader-friendly text:

### Icon-Only Buttons

```php
<button aria-label="Close modal">
  <x-icon.close />
</button>
```

### Hidden Visual Labels

```php
<button>
  <x-icon.search />
  <span class="sr-only">Search</span>
</button>
```

### Descriptive Links

```php
<a href="/docs" aria-label="Read the documentation">
  <x-icon.book />
</a>
```

## Color Contrast

All text meets or exceeds WCAG AA contrast requirements:

- **Normal text** (< 18pt): 4.5:1 contrast ratio
- **Large text** (≥ 18pt): 3:1 contrast ratio
- **UI components**: 3:1 contrast ratio against background

### Testing Contrast

Use tools to verify contrast:
- [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/)
- Chrome DevTools Lighthouse audit
- axe DevTools browser extension

## Semantic HTML

Velyx uses proper HTML5 semantic elements:

```php
<!-- Use correct element types -->
<nav aria-label="Main navigation">
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/docs">Documentation</a></li>
  </ul>
</nav>

<main>
  <h1>Page title</h1>
  <article>
    <h2>Article title</h2>
  </article>
</main>

<aside aria-label="Sidebar">
  <!-- Related content -->
</aside>

<footer>
  <!-- Footer content -->
</footer>
```

## Forms and Labels

All form inputs have proper labeling:

```php
<fieldset>
  <legend class="text-lg font-semibold">Notification Preferences</legend>

  <div>
    <input id="email-notif" type="checkbox" checked>
    <label for="email-notif">Email notifications</label>
  </div>

  <div>
    <input id="sms-notif" type="checkbox">
    <label for="sms-notif">SMS notifications</label>
  </div>
</fieldset>
```

### Error Messages

```php
<div>
  <label for="password">Password</label>
  <input
    id="password"
    type="password"
    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
    aria-describedby="{{ $errors->has('password') ? 'password-error' : 'password-hint' }}"
  >
  @error('password')
    <p id="password-error" class="text-destructive" role="alert">
      {{ $message }}
    </p>
  @enderror
</div>
```

## Skip Links

Include skip links for keyboard users:

```php
<a
  href="#main-content"
  class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary focus:text-primary-foreground focus:rounded-md"
>
  Skip to main content
</a>

<main id="main-content" tabindex="-1">
  <!-- Content -->
</main>
```

## Focus Indicators

All interactive elements have visible focus states:

```css
/* Ensure focus is always visible */
*:focus-visible {
  outline: 2px solid var(--ring);
  outline-offset: 2px;
}

/* Hide default focus for mouse users */
button:focus:not(:focus-visible) {
  outline: none;
}
```

## Motion and Animation

Respect user's motion preferences:

```css
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```

## Testing Accessibility

### Automated Testing

```bash
# Run Lighthouse CI
npx lhci autorun
```

```php
// Laravel Dusk test with a11y checks
test('homepage is accessible', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->assertSee('Velyx')
            ->screenshot('homepage');
    });
});
```

### Manual Testing Checklist

- [ ] Navigate entire site using keyboard only
- [ ] Test with screen reader (NVDA, JAWS, VoiceOver)
- [ ] Verify all images have alt text
- [ ] Check color contrast with color blindness simulator
- [ ] Test with browser zoom (200%)
- [ ] Verify form error messages are announced
- [ ] Check focus indicators are visible
- [ ] Test skip links work correctly

## Resources

- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [ARIA Authoring Practices Guide](https://www.w3.org/WAI/ARIA/apg/)
- [WebAIM Checklist](https://webaim.org/standards/wcag/checklist)
- [Inclusive Components](https://inclusive-components.design/)

## Known Limitations

We're continuously improving accessibility. Some areas we're working on:

- Enhanced screen reader announcements for dynamic content
- Better support for right-to-left languages
- Improved high-contrast mode support

Have feedback on accessibility? Please [open an issue](https://github.com/your-repo/issues).
