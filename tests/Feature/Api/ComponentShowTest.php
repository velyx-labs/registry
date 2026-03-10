<?php

test('can get component details', function () {
    $response = $this->getJson('/api/v1/components/button');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
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
        ])
        ->assertJsonPath('data.name', 'button')
        ->assertJsonPath('data.latest', '2.0.0');
});

test('can get specific version of component', function () {
    $response = $this->getJson('/api/v1/components/button?version=1.0.0');

    $response->assertOk()
        ->assertJsonPath('data.name', 'button')
        ->assertJsonPath('data.version', '1.0.0');
});

test('component defaults to latest version when not specified', function () {
    $response = $this->getJson('/api/v1/components/button');

    $response->assertOk()
        ->assertJsonPath('data.version', '2.0.0')
        ->assertJsonPath('data.latest', '2.0.0');
});

test('returns 404 for non existent component', function () {
    $response = $this->getJson('/api/v1/components/non-existent');

    $response->assertNotFound()
        ->assertJsonPath('error', 'Component not found');
});

test('returns 404 for non existent version', function () {
    $response = $this->getJson('/api/v1/components/button?version=9.9.9');

    $response->assertNotFound()
        ->assertJsonPath('error', 'Component not found');
});

test('returns validation error for invalid version format', function () {
    $response = $this->getJson('/api/v1/components/button?version=invalid');

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['version']);
});

test('returns validation error for invalid component name', function () {
    $response = $this->getJson('/api/v1/components/InvalidName');

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);
});

test('can include files in response', function () {
    $response = $this->getJson('/api/v1/components/button?include=files');

    $response->assertOk()
        ->assertJsonPath('data.name', 'button')
        ->assertJsonStructure([
            'data' => [
                'name',
                'version',
                'files',
            ],
        ]);

    $files = $response->json('data.files');
    expect($files)->not->toBeEmpty();
    expect($files)->toBeArray();
});

test('files are empty when include parameter is not set', function () {
    $response = $this->getJson('/api/v1/components/button');

    $response->assertOk();
    $data = $response->json('data');

    expect($data['files'])->toBeEmpty();
});

test('returns validation error for invalid include parameter', function () {
    $response = $this->getJson('/api/v1/components/button?include=invalid');

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['include']);
});


test('components with assets expose blade views inside a component folder', function () {
    $components = [
        'accordion',
        'alert',
        'carousel',
        'command-palette',
        'date-picker',
        'dialog',
        'drawer',
        'dropdown-menu',
        'file-upload',
        'input',
        'markdown-viewer',
        'popover',
        'range-slider',
        'rating',
        'sortable-list',
        'stepper',
        'tabs',
        'timeline',
        'toast',
        'toggle',
        'tooltip',
    ];

    foreach ($components as $component) {
        $response = $this->getJson('/api/v1/components/'.$component.'?include=files');

        $response->assertOk();

        $files = $response->json('data.files');

        expect($files)->toHaveKey('resources/views/components/ui/'.$component.'/index.blade.php');
        expect(array_keys($files))->toContain(fn (string $path) => str_contains($path, 'resources/js/ui/') || str_contains($path, 'resources/css/ui/'));
    }
});


test('multi-blade components expose their root view as index.blade.php', function () {
    $response = $this->getJson('/api/v1/components/tabs?include=files');

    $response->assertOk();

    $files = $response->json('data.files');

    expect($files)->toHaveKey('resources/views/components/ui/tabs/index.blade.php');
    expect($files)->toHaveKey('resources/views/components/ui/tabs/list.blade.php');
    expect($files)->toHaveKey('resources/views/components/ui/tabs/content.blade.php');
    expect($files)->toHaveKey('resources/views/components/ui/tabs/trigger.blade.php');
    expect($files)->not->toHaveKey('resources/views/components/ui/tabs/tabs.blade.php');
});
