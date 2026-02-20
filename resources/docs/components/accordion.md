# Accordion

Accordions allow users to expand and collapse content panels, useful for organizing large amounts of content or showing content on-demand.

## Installation

The accordion component requires Alpine.js. Include Alpine in your layout:

```blade
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

## Usage

### Basic Accordion

```blade
<x-ui.accordion :items="[
    ['title' => 'What is Velyx?', 'content' => 'Velyx is a UI component library...'],
    ['title' => 'How do I install it?', 'content' => 'Run the installation command...'],
    ['title' => 'Is it accessible?', 'content' => 'Yes, all components follow WCAG guidelines.'],
]" />
```

### With Rich Content

```blade
<x-ui.accordion :items="[
    [
        'title' => 'Getting Started',
        'answer' => '<p>Start by installing Velyx with Composer:</p><code>composer require velyx/ui</code>'
    ],
    [
        'title' => 'Configuration',
        'answer' => '<p>Add the service provider to your config/app.php file...</p>'
    ],
]" />
```

### Multiple Open Panels

```blade
<x-ui.accordion
    :items="$items"
    :multiple="true"
/>
```

### Default Open Panel

```blade
<x-ui.accordion
    :items="$items"
    defaultOpen="0"
/>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `items` | array | `[]` | Array of items with title/content or question/answer |
| `multiple` | bool | `false` | Allow multiple panels open at once |
| `defaultOpen` | int|string| `null` | Index or key of panel to be open by default |

## Examples

### FAQ Section

```blade
<section class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Frequently Asked Questions</h2>

    <x-ui.accordion :items="[
        [
            'question' => 'What makes Velyx different?',
            'answer' => 'Velyx is built specifically for Laravel with Livewire, providing a seamless development experience without complex frontend build tools.'
        ],
        [
            'question' => 'Can I customize the styling?',
            'answer' => 'Absolutely! Velyx uses Tailwind CSS and CSS custom properties, making it easy to customize colors, spacing, and more.'
        ],
        [
            'question' => 'Is Velyx accessible?',
            'answer' => 'Yes. All components follow WCAG 2.1 Level AA guidelines and include proper ARIA attributes, keyboard navigation, and screen reader support.'
        ],
        [
            'question' => 'Do I need JavaScript knowledge?',
            'answer' => 'Basic knowledge of Alpine.js is helpful for advanced interactions, but most components work out of the box with minimal configuration.'
        ],
    ]" />
</section>
```

### Documentation Sections

```blade
<div class="space-y-4">
    <x-ui.accordion :items="[
        [
            'title' => 'Installation',
            'content' => view('docs.partials.installation')
        ],
        [
            'title' => 'Configuration',
            'content' => view('docs.partials.configuration')
        ],
        [
            'title' => 'Troubleshooting',
            'content' => view('docs.partials.troubleshooting')
        ],
    ]" multiple />
</div>
```

### Nested Content

```blade
<x-ui.accordion :items="[
    [
        'title' => 'Product Features',
        'answer' => '
            <ul class="list-disc list-inside space-y-2">
                <li>Real-time updates with Livewire</li>
                <li>Responsive design out of the box</li>
                <li>Dark mode support</li>
                <li>Accessible by default</li>
            </ul>
        '
    ],
    [
        'title' => 'Pricing',
        'answer' => '
            <div class="grid grid-cols-3 gap-4">
                <div class="p-4 border rounded">
                    <h4 class="font-semibold">Free</h4>
                    <p class="text-2xl font-bold">$0</p>
                </div>
                <div class="p-4 border rounded">
                    <h4 class="font-semibold">Pro</h4>
                    <p class="text-2xl font-bold">$29</p>
                </div>
                <div class="p-4 border rounded">
                    <h4 class="font-semibold">Enterprise</h4>
                    <p class="text-2xl font-bold">$99</p>
                </div>
            </div>
        '
    ],
]" />
```

## Alpine.js Data

The accordion uses this Alpine.js component:

```js
function accordion({ multiple = false, defaultOpen = null }) {
    return {
        multiple,
        openItems: defaultOpen !== null ? [defaultOpen] : [],

        isOpen(index) {
            return this.openItems.includes(index);
        },

        toggle(index) {
            if (this.multiple) {
                if (this.isOpen(index)) {
                    this.openItems = this.openItems.filter(i => i !== index);
                } else {
                    this.openItems.push(index);
                }
            } else {
                this.openItems = this.isOpen(index) ? [] : [index];
            }
        }
    }
}
```

Include this in your app.js:

```js
document.addEventListener('alpine:init', () => {
    Alpine.data('accordion', accordion);
});
```

## Accessibility

The accordion includes full accessibility support:

### ARIA Attributes

- `aria-expanded` indicates panel state
- `aria-controls` links button to panel
- Proper heading hierarchy
- Keyboard navigation (Enter/Space to toggle)

### Keyboard Support

- `Tab` - Navigate to accordion
- `Enter/Space` - Toggle panel
- `Shift + Tab` - Navigate backwards

## Styling

Customize accordion styles:

```css
.accordion-item {
    border: 1px solid var(--border);
}

.accordion-header {
    @apply flex w-full items-center justify-between px-4 py-4 text-left;
    @apply font-medium text-foreground transition-colors;
    @apply hover:bg-accent/50;
}

.accordion-content {
    @apply border-t border-border bg-muted/30;
    @apply px-4 py-4;
}
```

## Best Practices

- Use for supplemental content, not critical information
- Keep titles short and descriptive
- Limit to 5-7 items for optimal UX
- Consider showing all content if items are few
- Provide context in titles, not just "Read More"

## Related Components

- [Tabs](/docs/components/tabs) - Alternative content organization
- [Dropdown](/docs/components/dropdown) - Menu interactions
- [Modal](/docs/components/modal) - Focused content display
