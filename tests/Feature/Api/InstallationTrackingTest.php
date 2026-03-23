<?php

use App\Models\ComponentInstallation;
use App\Models\Project;
use Illuminate\Support\Str;

test('can log component installation', function () {
    $projectId = Str::ulid();

    $response = $this->postJson('/api/v1/installations', [
        'project_id' => $projectId,
        'project_name' => 'Test Project',
        'component_name' => 'button',
        'component_version' => '1.0.0',
        'component_categories' => ['ui', 'forms'],
        'status' => 'success',
        'laravel_version' => '11.0.0',
        'php_version' => '8.3.0',
        'package_manager' => 'npm',
        'requires_alpine' => true,
        'files_count' => 5,
        'files_installed' => ['button.blade.php', 'button.js'],
    ]);

    $response->assertStatus(201);

    // Vérifier que le même ULID est conservé en base de données
    $this->assertDatabaseCount(Project::class, 1);
    $this->assertDatabaseHas(ComponentInstallation::class, [
        'project_id' => $projectId,
        'component_name' => 'button',
        'component_version' => '1.0.0',
        'status' => 'success',
    ]);

    $this->assertDatabaseHas(ComponentInstallation::class, [
        'project_id' => $projectId,
        'component_name' => 'button',
        'component_version' => '1.0.0',
        'status' => 'success',
    ]);
});

test('can get installation statistics', function () {
    ComponentInstallation::factory()->count(10)->create(['status' => 'success']);
    ComponentInstallation::factory()->count(2)->create(['status' => 'failed']);

    $response = $this->getJson('/api/v1/installations/stats');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'total_installations',
            'successful_installations',
            'failed_installations',
            'success_rate',
        ]);
});

test('can get popular components', function () {
    ComponentInstallation::factory()->count(5)->create(['component_name' => 'button', 'status' => 'success']);
    ComponentInstallation::factory()->count(3)->create(['component_name' => 'input', 'status' => 'success']);
    ComponentInstallation::factory()->count(2)->create(['component_name' => 'card', 'status' => 'success']);

    $response = $this->getJson('/api/v1/installations/popular');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'popular_components',
        ]);
});

test('validates required fields for installation logging', function () {
    $response = $this->postJson('/api/v1/installations', [
        'component_name' => 'button',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'project_id',
            'component_version',
            'status',
            'laravel_version',
            'php_version',
            'package_manager',
            'requires_alpine',
            'files_count',
        ]);
});