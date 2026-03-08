<?php

test('it resolves component dedicated preview view when available', function () {
    $response = $this->get('/preview/button');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.button.index');
});

test('it resolves accordion dedicated preview view when available', function () {
    $response = $this->get('/preview/accordion');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.accordion.index');
});

test('it applies array based variants from preview json', function () {
    $response = $this->get('/preview/button?variant=secondary');

    $response->assertOk()
        ->assertViewHas('currentVariant', 'secondary')
        ->assertViewHas('props', fn (array $props): bool => ($props['variant'] ?? null) === 'secondary');
});

test('it receives color scheme from webview query', function () {
    $response = $this->get('/preview/button?colorScheme=dark');

    $response->assertOk()
        ->assertViewHas('colorScheme', 'dark');
});
