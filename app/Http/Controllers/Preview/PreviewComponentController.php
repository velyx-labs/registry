<?php

declare(strict_types=1);

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use App\Services\ComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
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
        $componentName = $this->normalizeComponentName($component);

        // Validate component exists
        if (! $this->componentService->exists($componentName)) {
            abort(404, "Component '{$componentName}' not found.");
        }

        // Get override props from query parameters
        $props = $request->all();

        // Check if this is an interactive component
        $isInteractive = $this->isInteractiveComponent($componentName);
        $previewView = $this->resolvePreviewView($componentName, $isInteractive);
        $colorScheme = $this->resolveColorScheme($request);

        return Response::view('preview.template', [
            'component' => $componentName,
            'props' => $props,
            'isInteractive' => $isInteractive,
            'previewView' => $previewView,
            'colorScheme' => $colorScheme,
        ])
            ->header('Cache-Control', 'public, max-age=300')
            ->header('X-Preview-Component', $componentName);
    }

    protected function resolveColorScheme(Request $request): string
    {
        $colorScheme = (string) $request->query('colorScheme', $request->query('theme', 'system'));
        $normalized = strtolower(trim($colorScheme));

        if (! in_array($normalized, ['light', 'dark', 'system'], true)) {
            return 'system';
        }

        return $normalized;
    }

    protected function normalizeComponentName(string $component): string
    {
        return Str::of($component)
            ->replace('_', '-')
            ->kebab()
            ->toString();
    }

    protected function normalizeVariants(array $variants): array
    {
        if (array_is_list($variants)) {
            $normalized = [];

            foreach ($variants as $variant) {
                if (! is_array($variant) || ! isset($variant['name']) || ! isset($variant['props']) || ! is_array($variant['props'])) {
                    continue;
                }

                $name = (string) $variant['name'];
                $normalized[$name] = $variant['props'];
            }

            return $normalized;
        }

        return $variants;
    }

    protected function resolvePreviewView(string $component, bool $isInteractive): string
    {
        $variantView = "preview.components.{$component}";
        if (view()->exists($variantView)) {
            return $variantView;
        }

        $componentView = "preview.components.{$component}.index";
        if (view()->exists($componentView)) {
            return $componentView;
        }

        return $isInteractive ? 'preview.interactive-wrapper' : 'preview.static-wrapper';
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
