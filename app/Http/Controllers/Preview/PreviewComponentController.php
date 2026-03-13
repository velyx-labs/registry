<?php

declare(strict_types=1);

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use App\Services\ComponentService;
use Exception;
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

        $previewView = $this->resolvePreviewView($componentName);
        $colorScheme = $this->resolveColorScheme($request);

        return Response::view('preview.template', [
            'component' => $componentName,
            'props' => $props,
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

    protected function resolvePreviewView(string $component): string
    {
        $variantView = "preview.components.{$component}";
        if (view()->exists($variantView)) {
            return $variantView;
        }

        $componentView = "preview.components.{$component}.index";
        if (view()->exists($componentView)) {
            return $componentView;
        }

        throw new Exception("Preview view not found for component '{$component}'");
    }
}
