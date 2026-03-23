<?php

namespace App\Models;

use Database\Factories\ComponentInstallationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** @use HasFactory<ComponentInstallationFactory> */
#[Fillable([
    'project_id',
    'component_name',
    'component_version',
    'component_categories',
    'installed_at',
    'completed_at',
    'status',
    'laravel_version',
    'php_version',
    'package_manager',
    'composer_dependencies',
    'npm_dependencies',
    'requires_alpine',
    'files_count',
    'files_installed',
    'error_message',
    'error_stack',
])]
class ComponentInstallation extends BaseModel
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'installed_at' => 'datetime',
            'completed_at' => 'datetime',
            'component_categories' => 'array',
            'composer_dependencies' => 'array',
            'npm_dependencies' => 'array',
            'requires_alpine' => 'boolean',
            'files_count' => 'integer',
            'files_installed' => 'array',
        ];
    }

    /**
     * Get the project that owns the installation.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Scope a query to only include successful installations.
     */
    #[Scope]
    protected function success(Builder $query): void
    {
        $query->where('status', 'success');
    }

    /**
     * Scope a query to only include failed installations.
     */
    #[Scope]
    protected function failed(Builder $query): void
    {
        $query->where('status', 'failed');
    }

    /**
     * Scope a query to only include pending installations.
     */
    #[Scope]
    protected function pending(Builder $query): void
    {
        $query->where('status', 'pending');
    }

    /**
     * Get the installation time in seconds.
     */
    public function getInstallationTimeAttribute(): ?int
    {
        if (! $this->completed_at || ! $this->installed_at) {
            return null;
        }

        return (int) $this->completed_at->diffInSeconds($this->installed_at);
    }
}
