<?php

test('can get component versions', function () {
    $response = $this->getJson('/api/v1/components/button/versions');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'name',
                'latest',
                'versions',
            ],
        ])
        ->assertJsonPath('data.name', 'button')
        ->assertJsonPath('data.latest', '1.0.0')
        ->assertJsonPath('data.versions', fn ($versions) => count($versions) > 0);
});

test('versions are in correct order', function () {
    $response = $this->getJson('/api/v1/components/button/versions');

    $response->assertOk();
    $versions = $response->json('data.versions');

    expect($versions)->toBe([
        '1.0.0',
    ]);
});

test('returns 404 for non existent component versions', function () {
    $response = $this->getJson('/api/v1/components/non-existent/versions');

    $response->assertNotFound()
        ->assertJsonPath('error', 'Component not found');
});

test('returns validation error for invalid component name', function () {
    $response = $this->getJson('/api/v1/components/InvalidName/versions');

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);
});
