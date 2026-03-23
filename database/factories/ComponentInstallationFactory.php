<?php

namespace Database\Factories;

use App\Models\ComponentInstallation;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ComponentInstallationFactory extends Factory
{
    protected $model = ComponentInstallation::class;

    public function definition(): array
    {
        return [
            'component_name' => $this->faker->word(),
            'component_version' => '1.0.0',
            'component_categories' => $this->faker->words(),
            'installed_at' => Carbon::now(),
            'completed_at' => Carbon::now(),
            'status' => 'success',
            'laravel_version' => '11.0.0',
            'php_version' => '8.3',
            'package_manager' => 'npm',
            'composer_dependencies' => $this->faker->words(),
            'npm_dependencies' => $this->faker->words(),
            'requires_alpine' => $this->faker->boolean(),
            'files_count' => $this->faker->numberBetween(1, 10),
            'files_installed' => $this->faker->words(),
            'error_message' => null,
            'error_stack' => null,
            'project_id' => Project::factory(),
        ];
    }
}