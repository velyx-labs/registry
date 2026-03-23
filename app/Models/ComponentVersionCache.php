<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'component_name',
    'version',
    'metadata',
    'last_synced_at',
])]
class ComponentVersionCache extends BaseModel
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
            'metadata' => 'array',
            'last_synced_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to filter by component name.
     */
    #[Scope]
    protected function forComponent(Builder $query, string $componentName): void
    {
        $query->where('component_name', $componentName);
    }

    /**
     * Scope a query to only include stale cache entries.
     */
    #[Scope]
    protected function stale(Builder $query): void
    {
        $query->where('last_synced_at', '<', now()->subHours(24));
    }

    /**
     * Scope a query to only include fresh cache entries.
     */
    #[Scope]
    protected function fresh(Builder $query): void
    {
        $query->where('last_synced_at', '>=', now()->subHours(24));
    }

    /**
     * Check if the cache entry is stale.
     */
    public function isStale(): bool
    {
        return $this->last_synced_at->lt(now()->subHours(24));
    }

    /**
     * Get the metadata as an array.
     */
    public function getMetadataArray(): array
    {
        return $this->metadata ?? [];
    }
}
