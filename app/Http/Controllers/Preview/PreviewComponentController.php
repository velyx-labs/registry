<?php

declare(strict_types=1);

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use App\Services\ComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PreviewComponentController extends Controller
{
    public function __construct(
        protected ComponentService $componentService
    ) {}

    /**
     * Render a component preview with default or custom props
     */
    public function __invoke(Request $request, string $component): HttpResponse
    {
        // Normalize component name (kebab-case to lowercase for directory lookup)
        $componentName = strtolower(str_replace(['-', '_'], '', $component));

        // Validate component exists
        if (! $this->componentService->exists($componentName)) {
            abort(404, "Component '{$componentName}' not found.");
        }

        // Get default props from preview.json
        $defaultProps = $this->getDefaultProps($componentName);

        // Get override props from query parameters
        $overrides = $request->except(['variant']);
        $props = array_merge($defaultProps, $overrides);

        // Get available variants
        $variants = $this->getVariants($componentName);

        // Determine current variant
        $variant = $request->query('variant', 'default');
        if (isset($variants[$variant])) {
            $props = array_merge($props, $variants[$variant]);
        }

        // Check if this is an interactive component
        $isInteractive = $this->isInteractiveComponent($componentName);

        return Response::view('preview.template', [
            'component' => $componentName,
            'props' => $props,
            'variants' => $variants,
            'currentVariant' => $variant,
            'isInteractive' => $isInteractive,
        ])
            ->header('Cache-Control', 'public, max-age=300')
            ->header('X-Preview-Component', $componentName);
    }

    /**
     * Get default props from component's preview.json
     */
    protected function getDefaultProps(string $component): array
    {
        $previewConfig = $this->getPreviewConfig($component);

        return $previewConfig['default'] ?? [];
    }

    /**
     * Get available variants from component's preview.json
     */
    protected function getVariants(string $component): array
    {
        $previewConfig = $this->getPreviewConfig($component);

        $variants = $previewConfig['variants'] ?? [];

        // Always include default variant
        return array_merge([
            'default' => $previewConfig['default'] ?? [],
        ], $variants);
    }

    /**
     * Load preview.json configuration for a component
     */
    protected function getPreviewConfig(string $component): array
    {
        $componentPath = $this->componentService->getComponentPath($component);
        $previewFile = "{$componentPath}/preview.json";

        if (! file_exists($previewFile)) {
            return [];
        }

        $content = file_get_contents($previewFile);
        $config = json_decode($content, true);

        return $config ?? [];
    }

    /**
     * Check if component requires interactive preview handling
     */
    protected function isInteractiveComponent(string $component): bool
    {
        $interactiveComponents = config('preview.interactive_components', [
            'modal',
            'drawer',
            'alert',
            'dropdown',
            'tooltip',
            'popover',
            'dialog',
        ]);

        return in_array($component, $interactiveComponents, true);
    }

    /**
     * Get trigger methods for interactive components
     */
    protected function getTriggerMethods(string $component): array
    {
        $methods = [
            'modal' => [
                'openModal' => 'function() { this.open = true }',
                'closeModal' => 'function() { this.open = false }',
                'toggleModal' => 'function() { this.open = !this.open }',
            ],
            'drawer' => [
                'openDrawer' => 'function(pos) { this.position = pos; this.open = true }',
                'closeDrawer' => 'function() { this.open = false }',
                'toggleDrawer' => 'function() { this.open = !this.open }',
            ],
            'alert' => [
                'showAlert' => 'function(variant) { this.variant = variant; this.visible = true }',
                'hideAlert' => 'function() { this.visible = false }',
            ],
            'dropdown' => [
                'toggleDropdown' => 'function() { this.open = !this.open }',
                'closeDropdown' => 'function() { this.open = false }',
                'openDropdown' => 'function() { this.open = true }',
            ],
            'tooltip' => [
                'showTooltip' => 'function() { this.visible = true }',
                'hideTooltip' => 'function() { this.visible = false }',
            ],
            'popover' => [
                'togglePopover' => 'function() { this.open = !this.open }',
                'closePopover' => 'function() { this.open = false }',
                'openPopover' => 'function() { this.open = true }',
            ],
            'dialog' => [
                'openDialog' => 'function() { this.open = true }',
                'closeDialog' => 'function() { this.open = false }',
                'confirmDialog' => 'function() { this.$dispatch("dialog-confirm") }',
                'cancelDialog' => 'function() { this.$dispatch("dialog-cancel") }',
            ],
        ];

        return $methods[$component] ?? [];
    }
}
