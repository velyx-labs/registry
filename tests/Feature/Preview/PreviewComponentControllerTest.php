<?php

test('it resolves component dedicated preview view when available', function () {
    $response = $this->get('/preview/button');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.button.index');
});

test('it applies array based variants from preview json', function () {
    $response = $this->get('/preview/button?variant=secondary');

    $response->assertOk()
        ->assertViewHas('currentVariant', 'secondary')
        ->assertViewHas('props', fn (array $props): bool => ($props['variant'] ?? null) === 'secondary');
});
