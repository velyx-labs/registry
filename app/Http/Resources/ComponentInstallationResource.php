<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponentInstallationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project' => [
                'id' => $this->project_id,
                'name' => $this->project->name ?? null,
            ],
            'component' => [
                'name' => $this->component_name,
                'version' => $this->component_version,
                'categories' => $this->component_categories ?? [],
            ],
            'timestamps' => [
                'installed_at' => $this->installed_at?->toIso8601String(),
                'completed_at' => $this->completed_at?->toIso8601String(),
                'installation_time_seconds' => $this->installation_time,
            ],
            'status' => $this->status,
            'environment' => [
                'laravel_version' => $this->laravel_version,
                'php_version' => $this->php_version,
                'package_manager' => $this->package_manager,
                'requires_alpine' => $this->requires_alpine,
            ],
            'dependencies' => [
                'composer' => $this->composer_dependencies ?? [],
                'npm' => $this->npm_dependencies ?? [],
            ],
            'files' => [
                'count' => $this->files_count,
                'installed' => $this->files_installed ?? [],
            ],
            'error' => $this->when($this->status === 'failed', [
                'message' => $this->error_message,
                'stack' => $this->error_stack,
            ]),
        ];
    }
}