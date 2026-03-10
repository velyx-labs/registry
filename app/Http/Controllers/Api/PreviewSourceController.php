<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PreviewSourceController extends Controller
{
    /**
     * GET /api/v1/previews/{component}/source
     * Get the source code for the preview view rendered in the docs iframe.
     */
    public function __invoke(Request $request, string $component): JsonResponse
    {
        $componentName = Str::of($component)
            ->replace('_', '-')
            ->kebab()
            ->toString();

        $path = $this->resolvePreviewSourcePath($componentName);

        if ($path === null) {
            return response()->json([
                'error' => 'Preview source not found',
            ], 404);
        }

        return response()->json([
            'data' => [
                'component' => $componentName,
                'variant' => (string) $request->query('variant', 'default'),
                'path' => Str::after($path, resource_path('views').'/'),
                'source' => file_get_contents($path),
            ],
        ]);
    }

    protected function resolvePreviewSourcePath(string $component): ?string
    {
        $candidates = [
            resource_path("views/preview/components/{$component}.blade.php"),
            resource_path("views/preview/components/{$component}/index.blade.php"),
        ];

        foreach ($candidates as $candidate) {
            if (is_file($candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
