<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstallationRequest;
use App\Http\Resources\ComponentInstallationResource;
use App\Models\ComponentInstallation;
use App\Services\InstallationTrackingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InstallationController extends Controller
{
    public function __construct(
        protected InstallationTrackingService $trackingService
    ) {}

    /**
     * GET /api/v1/installations
     * List all installations
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $limit = $request->integer('limit', 50);
        $offset = $request->integer('offset');

        $installations = ComponentInstallation::query()
            ->with('project')
            ->orderBy('installed_at', 'desc')
            ->limit($limit)
            ->offset($offset)
            ->get();

        return ComponentInstallationResource::collection($installations);
    }

    /**
     * POST /api/v1/installations
     * Log component installation
     */
    public function store(StoreInstallationRequest $request): JsonResponse
    {
        $installation = $this->trackingService->logInstallation($request->validated());

        return ComponentInstallationResource::make($installation)->response()->setStatusCode(201);
    }

    /**
     * GET /api/v1/installations/stats
     * Get installation statistics
     */
    public function stats(): JsonResponse
    {
        $stats = $this->trackingService->getInstallationStats();

        return response()->json($stats);
    }

    /**
     * GET /api/v1/installations/popular
     * Get popular components
     */
    public function popular(Request $request): JsonResponse
    {
        $limit = $request->integer('limit', 10);

        return response()->json([
            'popular_components' => $this->trackingService->getPopularComponents($limit),
        ]);
    }

    /**
     * GET /api/v1/installations/trends
     * Get installation trends
     */
    public function trends(Request $request): JsonResponse
    {
        $days = $request->integer('days', 30);

        return response()->json([
            'trends' => $this->trackingService->getInstallationTrends($days),
        ]);
    }

    /**
     * GET /api/v1/installations/components/{component}
     * Get component adoption statistics
     */
    public function component(string $component): JsonResponse
    {
        return response()->json(
            $this->trackingService->getComponentAdoption($component)
        );
    }

    /**
     * GET /api/v1/installations/projects
     * Get all tracked projects
     */
    public function projects(): JsonResponse
    {
        return response()->json([
            'projects' => $this->trackingService->getTopProjects(),
        ]);
    }

    /**
     * GET /api/v1/installations/projects/{project}
     * Get project installation history
     */
    public function projectHistory(string $project): JsonResponse
    {
        return response()->json(
            $this->trackingService->getProjectHistory($project)
        );
    }
}
