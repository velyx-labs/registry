<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ComponentService;
use Illuminate\View\View;

class PreviewController extends Controller
{
    protected ComponentService $componentService;

    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }

    /**
     * Display all components listing page
     */
    public function index(): View
    {
        try {
            $components = $this->componentService->getAllComponents();

            // Transform for web display
            $webComponents = [];
            foreach ($components as $name => $data) {
                $webComponents[$name] = [
                    'name' => $name,
                    'version' => $data['latest'],
                    'description' => $data['meta']['description'],
                    'requires_alpine' => $data['meta']['requires_alpine'],
                    'requires' => $data['meta']['requires'],
                    'laravel' => $data['meta']['laravel'],
                    'all_versions' => $data['versions'],
                ];
            }

            return view('web.components.index', [
                'components' => collect($webComponents)->sortBy('name'),
                'total' => count($webComponents),
            ]);
        } catch (\Exception $e) {
            return view('web.error', [
                'error' => 'Failed to load components: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Display specific component preview
     */
    public function show(string $name, ?string $version = null): View
    {
        if (! $this->componentService->isValidComponentName($name)) {
            abort(404, 'Invalid component name');
        }

        try {
            $component = $this->componentService->getComponent($name, $version);

            if (! $component) {
                abort(404, 'Component not found');
            }

            // Get available versions
            $versionsPath = base_path("registry/components/{$name}/versions.json");
            $versions = [];
            if (file_exists($versionsPath)) {
                $versionsData = json_decode(file_get_contents($versionsPath), true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $versions = $versionsData['versions'] ?? [];
                }
            }

            return view('web.components.show', [
                'component' => $component,
                'all_versions' => $versions,
                'current_version' => $component['version'],
            ]);
        } catch (\Exception $e) {
            return view('web.error', [
                'error' => 'Failed to load component: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Render component blade file directly
     */
    public function render(string $name, ?string $version = null): View|string
    {
        if (! $this->componentService->isValidComponentName($name)) {
            abort(404, 'Invalid component name');
        }

        try {
            $component = $this->componentService->getComponent($name, $version);

            if (! $component) {
                abort(404, 'Component not found');
            }

            // Find the blade file in component files
            $bladeContent = null;
            $bladePath = null;

            foreach ($component['files'] as $path => $content) {
                if (str_ends_with($path, '.blade.php')) {
                    $bladeContent = $content;
                    // Extract filename for view resolution
                    $bladePath = base_path("registry/components/{$name}/{$component['version']}/{$name}.blade.php");
                    break;
                }
            }

            if (! $bladeContent) {
                abort(404, 'Blade template not found for component');
            }

            // Create a temporary view file if it doesn't exist
            $tempViewPath = base_path("resources/views/web/components/temp/{$name}_{$component['version']}.blade.php");
            $tempDir = dirname($tempViewPath);

            if (! is_dir($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            // Write blade content to temp file
            file_put_contents($tempViewPath, $bladeContent);

            // Load component assets (CSS/JS)
            $cssContent = '';
            $jsContent = '';
            $requiresAlpine = false;

            foreach ($component['files'] as $path => $content) {
                if (str_ends_with($path, '.css')) {
                    $cssContent = $content;
                } elseif (str_ends_with($path, '.js')) {
                    $jsContent = $content;
                }
            }

            $requiresAlpine = $component['meta']['requires_alpine'] ?? false;

            return view('web.components.render', [
                'blade_content' => $bladeContent,
                'css_content' => $cssContent,
                'js_content' => $jsContent,
                'requires_alpine' => $requiresAlpine,
                'component_name' => $name,
                'version' => $component['version'],
            ]);
        } catch (\Exception $e) {
            return view('web.error', [
                'error' => 'Failed to render component: '.$e->getMessage(),
            ]);
        }
    }
}
