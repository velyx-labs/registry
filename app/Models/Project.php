<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @use HasFactory<ProjectFactory> */
#[Fillable([
    'id',
    'name',
    'first_seen_at',
    'last_seen_at',
])]
class Project extends BaseModel
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
            'first_seen_at' => 'datetime',
            'last_seen_at' => 'datetime',
        ];
    }

    /**
     * Get the component installations for the project.
     */
    public function installations(): HasMany
    {
        return $this->hasMany(ComponentInstallation::class, 'project_id');
    }

    /**
     * Scope a query to only include active projects.
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('last_seen_at', '>=', now()->subDays(30));
    }

    /**
     * Scope a query to only include recent projects.
     */
    #[Scope]
    protected function recent(Builder $query): void
    {
        $query->where('first_seen_at', '>=', now()->subDays(7));
    }
}
