<?php

namespace Database\Factories;

use App\Models\ComponentVersionCache;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ComponentVersionCacheFactory extends Factory
{
    protected $model = ComponentVersionCache::class;

    public function definition(): array
    {
        return [
            'component_name' => $this->faker->name(),
            'version' => $this->faker->word(),
            'metadata' => $this->faker->words(),
            'last_synced_at' => Carbon::now(),
        ];
    }
}
