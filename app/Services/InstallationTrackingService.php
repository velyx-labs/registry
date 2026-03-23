<?php

namespace App\Services;

use App\Models\ComponentInstallation;
use App\Models\ComponentVersionCache;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class InstallationTrackingService
{
    /**
     * Log a component installation.
     */
    public function logInstallation(array $data): ComponentInstallation
    {
        // Find or create project by ULID (client-generated ID)
        $project = Project::firstOrCreate(
            ['id' => $data['project_id']],
            [
                'name' => $data['project_name'] ?? null,
                'first_seen_at' => now(),
                'last_seen_at' => now(),
            ]
        );

        // Update last_seen_at for existing projects
        if (! $project->wasRecentlyCreated) {
            $project->update(['last_seen_at' => now()]);
        }

        // Create installation record
        $installation = ComponentInstallation::create([
            'project_id' => $project->id,
            'component_name' => $data['component_name'],
            'component_version' => $data['component_version'],
            'component_categories' => $data['component_categories'] ?? null,
            'installed_at' => $data['installed_at'] ?? now(),
            'completed_at' => $data['completed_at'] ?? now(),
            'status' => $data['status'] ?? 'success',
            'laravel_version' => $data['laravel_version'],
            'php_version' => $data['php_version'],
            'package_manager' => $data['package_manager'],
            'composer_dependencies' => $data['composer_dependencies'] ?? null,
            'npm_dependencies' => $data['npm_dependencies'] ?? null,
            'requires_alpine' => $data['requires_alpine'] ?? false,
            'files_count' => $data['files_count'] ?? 0,
            'files_installed' => $data['files_installed'] ?? null,
            'error_message' => $data['error_message'] ?? null,
            'error_stack' => $data['error_stack'] ?? null,
        ]);

        // Invalidate cache for this component
        $this->clearComponentCache($data['component_name']);

        return $installation;
    }

    /**
     * Get installation statistics.
     */
    public function getInstallationStats(): array
    {
        $cacheKey = 'installation.stats';

        return Cache::remember($cacheKey, now()->addHours(1), function () {
            return [
                'total_installations' => ComponentInstallation::count(),
                'successful_installations' => ComponentInstallation::success()->count(),
                'failed_installations' => ComponentInstallation::failed()->count(),
                'pending_installations' => ComponentInstallation::pending()->count(),
                'unique_projects' => Project::count(),
                'active_projects' => Project::active()->count(),
                'popular_components' => $this->getPopularComponents(),
                'top_projects' => $this->getTopProjects(),
                'installation_trends' => $this->getInstallationTrends(),
                'success_rate' => $this->getSuccessRate(),
            ];
        });
    }

    /**
     * Get popular components.
     */
    public function getPopularComponents(int $limit = 10): array
    {
        return ComponentInstallation::query()
            ->select('component_name', DB::raw('count(*) as installation_count'))
            ->success()
            ->groupBy('component_name')
            ->orderByDesc('installation_count')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Get top projects.
     */
    public function getTopProjects(int $limit = 10): array
    {
        return Project::withCount('installations')
            ->orderByDesc('installations_count')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Get installation trends (last 30 days).
     */
    public function getInstallationTrends(int $days = 30): array
    {
        return ComponentInstallation::query()
            ->select(DB::raw('DATE(installed_at) as date'), DB::raw('count(*) as count'))
            ->where('installed_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
    }

    /**
     * Get success rate.
     */
    public function getSuccessRate(): float
    {
        $total = ComponentInstallation::count();

        if ($total === 0) {
            return 100.0;
        }

        $successful = ComponentInstallation::success()->count();

        return round(($successful / $total) * 100, 2);
    }

    /**
     * Get component adoption statistics.
     */
    public function getComponentAdoption(string $componentName): array
    {
        $cacheKey = "component.{$componentName}.adoption";

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($componentName) {
            $installations = ComponentInstallation::forComponent($componentName)
                ->select('version', 'status', 'installed_at', 'laravel_version', 'php_version')
                ->orderBy('installed_at', 'desc')
                ->get()
                ->groupBy('version');

            return [
                'component' => $componentName,
                'total_installations' => $installations->sum->count(),
                'by_version' => $installations->mapWithKeys(fn ($group, $version) => [
                    $version => $group->count(),
                ]),
                'latest_installations' => ComponentInstallation::forComponent($componentName)
                    ->success()
                    ->orderBy('installed_at', 'desc')
                    ->limit(10)
                    ->get()
                    ->toArray(),
            ];
        });
    }

    /**
     * Get project installation history.
     */
    public function getProjectHistory(string $projectId): array
    {
        $cacheKey = "project.{$projectId}.history";

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($projectId) {
            return Project::with(['installations' => fn ($query) => $query->orderBy('installed_at', 'desc')])
                ->find($projectId)
                ?->toArray() ?? [];
        });
    }

    /**
     * Clear component cache.
     */
    public function clearComponentCache(string $componentName): void
    {
        Cache::forget("component.{$componentName}.adoption");
        Cache::forget('installation.stats');
    }

    /**
     * Cache component metadata.
     */
    public function cacheComponentMetadata(string $componentName, string $version, array $metadata): void
    {
        ComponentVersionCache::updateOrCreate(
            [
                'component_name' => $componentName,
                'version' => $version,
            ],
            [
                'metadata' => $metadata,
                'last_synced_at' => now(),
            ]
        );
    }

    /**
     * Get cached component metadata.
     */
    public function getCachedMetadata(string $componentName, string $version): ?array
    {
        $cache = ComponentVersionCache::query()
            ->where('component_name', $componentName)
            ->where('version', $version)
            ->where('last_synced_at', '>=', now()->subHours(24))
            ->first();

        return $cache?->metadata;
    }

    /**
     * Cleanup old installation records.
     */
    public function cleanupOldRecords(int $days = 90): int
    {
        return ComponentInstallation::where('installed_at', '<', now()->subDays($days))
            ->delete();
    }
}
