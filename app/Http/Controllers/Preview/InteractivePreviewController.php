<?php

declare(strict_types=1);

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use App\Services\ComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Preview controller for interactive components
 * Handles components that require user interaction (modals, drawers, dropdowns, etc.)
 */
class InteractivePreviewController extends Controller
{
    public function __construct(
        protected ComponentService $componentService
    ) {}

    public function __invoke(Request $request, string $component): HttpResponse
    {
        // Normalize component name
        $componentName = $this->normalizeComponentName($component);

        // Validate component exists
        if (! $this->componentService->exists($componentName)) {
            abort(404, "Component '{$componentName}' not found.");
        }

        // Get interactive context for this component
        $context = $this->getInteractiveContext($componentName);

        // Get default props
        $defaultProps = $this->getDefaultProps($componentName);

        // Merge with query parameter overrides
        $overrides = $request->except(['token']);
        $props = array_merge($defaultProps, $overrides);

        // Get component metadata
        $metadata = $this->componentService->getMetadata($componentName);

        return Response::view('preview.interactive', [
            'component' => $componentName,
            'props' => $props,
            'context' => $context,
            'metadata' => $metadata,
        ])
            ->header('Cache-Control', 'private, max-age=300')
            ->header('X-Preview-Component', $componentName)
            ->header('X-Preview-Type', 'interactive');
    }

    /**
     * Normalize component name from URL format to class name
     */
    protected function normalizeComponentName(string $component): string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $component)));
    }

    /**
     * Get interactive context configuration for component
     */
    protected function getInteractiveContext(string $component): array
    {
        $contexts = [
            'Modal' => [
                'requiresOverlay' => true,
                'autoOpen' => true,
                'closeOnOutsideClick' => true,
                'closeOnEscape' => true,
                'testTriggers' => [
                    ['label' => 'Open Modal', 'action' => 'openModal()'],
                    ['label' => 'Close Modal', 'action' => 'closeModal()'],
                    ['label' => 'Toggle', 'action' => 'toggleModal()'],
                ],
                'alpineData' => 'modalPreview',
            ],
            'Drawer' => [
                'requiresOverlay' => true,
                'autoOpen' => true,
                'positions' => ['left', 'right', 'top', 'bottom'],
                'defaultPosition' => 'right',
                'testTriggers' => [
                    ['label' => 'Open Right', 'action' => 'openDrawer("right")'],
                    ['label' => 'Open Left', 'action' => 'openDrawer("left")'],
                    ['label' => 'Close', 'action' => 'closeDrawer()'],
                ],
                'alpineData' => 'drawerPreview',
            ],
            'Alert' => [
                'dismissible' => true,
                'autoDismiss' => false,
                'variants' => ['info', 'success', 'warning', 'error'],
                'testTriggers' => [
                    ['label' => 'Show Info', 'action' => 'showAlert("info")'],
                    ['label' => 'Show Success', 'action' => 'showAlert("success")'],
                    ['label' => 'Show Warning', 'action' => 'showAlert("warning")'],
                    ['label' => 'Show Error', 'action' => 'showAlert("error")'],
                ],
                'alpineData' => 'alertPreview',
            ],
            'Dropdown' => [
                'clickToOpen' => true,
                'hoverToOpen' => false,
                'closeOnOutsideClick' => true,
                'testTriggers' => [
                    ['label' => 'Toggle Dropdown', 'action' => 'toggleDropdown()'],
                ],
                'alpineData' => 'dropdownPreview',
            ],
            'Tooltip' => [
                'hoverToShow' => true,
                'focusToShow' => true,
                'positions' => ['top', 'bottom', 'left', 'right'],
                'testTriggers' => [
                    ['label' => 'Hover me', 'action' => ''],
                ],
                'alpineData' => 'tooltipPreview',
            ],
            'Popover' => [
                'clickToShow' => true,
                'closeOnOutsideClick' => true,
                'testTriggers' => [
                    ['label' => 'Toggle Popover', 'action' => 'togglePopover()'],
                ],
                'alpineData' => 'popoverPreview',
            ],
            'Dialog' => [
                'requiresOverlay' => true,
                'autoOpen' => true,
                'closeOnOutsideClick' => false,
                'closeOnEscape' => true,
                'testTriggers' => [
                    ['label' => 'Open Dialog', 'action' => 'openDialog()'],
                    ['label' => 'Confirm', 'action' => 'confirmDialog()'],
                    ['label' => 'Cancel', 'action' => 'cancelDialog()'],
                ],
                'alpineData' => 'dialogPreview',
            ],
        ];

        return $contexts[$component] ?? [
            'testTriggers' => [],
            'alpineData' => 'defaultPreview',
        ];
    }

    /**
     * Get default props for component
     */
    protected function getDefaultProps(string $component): array
    {
        $previewConfig = $this->getPreviewConfig($component);

        return $previewConfig['default'] ?? [];
    }

    /**
     * Load preview.json configuration
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
}
