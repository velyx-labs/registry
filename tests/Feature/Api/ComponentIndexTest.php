<?php

test('can list all components', function () {
    $response = $this->getJson('/api/v1/components');

    $response->assertOk()
        ->assertJsonStructure([
            'data',
            'count',
        ])
        ->assertJsonPath('count', fn ($count) => $count > 0);
});

test('components list has correct structure', function () {
    $response = $this->getJson('/api/v1/components');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'latest',
                    'versions',
                    'description',
                    'requires_alpine',
                    'requires',
                    'categories',
                    'files',
                    'laravel',
                ],
            ],
            'count',
        ]);
});

test('component does not include file contents by default', function () {
    $response = $this->getJson('/api/v1/components');

    $response->assertOk();
    $data = $response->json('data');

    expect($data)->not->toBeEmpty();

    // Get the first component key
    $firstComponentKey = array_key_first($data);
    expect($data[$firstComponentKey]['files'])->toBeEmpty();
});
