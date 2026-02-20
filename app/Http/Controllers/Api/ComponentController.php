<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ComponentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComponentController extends Controller
{
    protected ComponentService $componentService;

    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }

    /**
     * GET /api/v1/components
     * List all available components
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $components = $this->componentService->getAllComponents();

            // Return simplified list for index endpoint
            $componentList = [];
            foreach ($components as $name => $data) {
                $componentList[] = [
                    'name' => $name,
                    'latest' => $data['latest'],
                    'versions' => $data['versions'],
                    'description' => $data['meta']['description'],
                    'requires_alpine' => $data['meta']['requires_alpine'],
                    'requires' => $data['meta']['requires'],
                    'categories' => $data['meta']['categories'],
                    'files' => $data['files'],
                    'laravel' => $data['meta']['laravel'],
                ];
            }

            return response()->json([
                'data' => $componentList,
                'count' => count($componentList),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal server error',
                'message' => 'Failed to retrieve components list',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * GET /api/v1/components/{name}
     * Get detailed component information
     */
    public function show(Request $request, string $name): JsonResponse
    {
        try {
            // Validate component name
            if (! $this->componentService->isValidComponentName($name)) {
                return response()->json([
                    'error' => 'Invalid component name',
                    'message' => 'Component name must contain only lowercase letters, numbers, hyphens, and underscores',
                ], Response::HTTP_BAD_REQUEST);
            }

            // Get version from query parameter, default to latest
            $version = $request->query('version');

            if ($version && ! $this->componentService->isValidVersion($version)) {
                return response()->json([
                    'error' => 'Invalid version format',
                    'message' => 'Version must follow semantic versioning format (e.g., 1.0.0)',
                ], Response::HTTP_BAD_REQUEST);
            }

            $component = $this->componentService->getComponent($name, $version);

            if (! $component) {
                return response()->json([
                    'error' => 'Component not found',
                    'message' => "Component '{$name}' ".($version ? "version '{$version}' " : '').'does not exist',
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json($component);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal server error',
                'message' => 'Failed to retrieve component',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * GET /api/v1/components/{name}/versions
     * Get available versions for a component
     */
    public function versions(string $name): JsonResponse
    {
        try {
            if (! $this->componentService->isValidComponentName($name)) {
                return response()->json([
                    'error' => 'Invalid component name',
                    'message' => 'Component name must contain only lowercase letters, numbers, hyphens, and underscores',
                ], Response::HTTP_BAD_REQUEST);
            }

            if (! $this->componentService->componentExists($name)) {
                return response()->json([
                    'error' => 'Component not found',
                    'message' => "Component '{$name}' does not exist",
                ], Response::HTTP_NOT_FOUND);
            }

            $component = $this->componentService->getComponent($name);

            return response()->json([
                'name' => $name,
                'latest' => $component['latest'],
                'versions' => $component['versions'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal server error',
                'message' => 'Failed to retrieve component versions',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
