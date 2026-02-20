<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ComponentNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComponentShowRequest;
use App\Http\Requests\ComponentVersionsRequest;
use App\Http\Resources\ComponentCollection;
use App\Http\Resources\ComponentResource;
use App\Http\Resources\ComponentVersionResource;
use App\Services\ComponentService;

class ComponentController extends Controller
{
    public function __construct(
        protected ComponentService $componentService,
    ) {}

    /**
     * GET /api/v1/components
     * List all available components
     */
    public function index(): ComponentCollection
    {
        $components = $this->componentService->getAllComponents();

        return new ComponentCollection(collect($components));
    }

    /**
     * GET /api/v1/components/{name}
     * Get detailed component information
     *
     * Query parameters:
     * - version: Optional version to retrieve (default: latest)
     * - include: Optional includes (e.g., ?include=files to load file contents)
     *
     * @throws ComponentNotFoundException
     */
    public function show(ComponentShowRequest $request, string $name): ComponentResource
    {
        $version = $request->query('version');
        $includeFiles = $request->query('include') === 'files';

        $component = $includeFiles
            ? $this->componentService->getComponentWithFiles($name, $version)
            : $this->componentService->getComponent($name, $version);

        return new ComponentResource($component);
    }

    /**
     * GET /api/v1/components/{name}/versions
     * Get available versions for a component
     *
     * @throws ComponentNotFoundException
     */
    public function versions(ComponentVersionsRequest $request, string $name): ComponentVersionResource
    {
        $versions = $this->componentService->getVersions($name);

        return new ComponentVersionResource($versions);
    }
}
