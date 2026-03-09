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

test('it resolves alert dedicated preview view when available', function () {
    $response = $this->get('/preview/alert');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.alert.index');
});

test('it resolves avatar dedicated preview view when available', function () {
    $response = $this->get('/preview/avatar');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.avatar.index');
});

test('it resolves avatar-group dedicated preview view when available', function () {
    $response = $this->get('/preview/avatar-group');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.avatar-group.index');
});

test('it resolves badge dedicated preview view when available', function () {
    $response = $this->get('/preview/badge');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.badge.index');
});

test('it resolves breadcrumbs dedicated preview view when available', function () {
    $response = $this->get('/preview/breadcrumbs');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.breadcrumbs.index');
});

test('it resolves card dedicated preview view when available', function () {
    $response = $this->get('/preview/card');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.card.index');
});

test('it resolves command-palette dedicated preview view when available', function () {
    $response = $this->get('/preview/command-palette');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.command-palette.index');
});

test('it resolves markdown-viewer dedicated preview view when available', function () {
    $response = $this->get('/preview/markdown-viewer');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.markdown-viewer.index');
});

test('it resolves table dedicated preview view when available', function () {
    $response = $this->get('/preview/table');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.table.index');
});

test('it resolves date-picker dedicated preview view when available', function () {
    $response = $this->get('/preview/date-picker');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.date-picker.index');
});

test('it resolves drawer dedicated preview view when available', function () {
    $response = $this->get('/preview/drawer');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.drawer.index');
});

test('it resolves dropdown-menu dedicated preview view when available', function () {
    $response = $this->get('/preview/dropdown-menu');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.dropdown-menu.index');
});

test('it resolves empty-state dedicated preview view when available', function () {
    $response = $this->get('/preview/empty-state');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.empty-state.index');
});

test('it resolves file-upload dedicated preview view when available', function () {
    $response = $this->get('/preview/file-upload');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.file-upload.index');
});

test('it resolves kbd dedicated preview view when available', function () {
    $response = $this->get('/preview/kbd');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.kbd.index');
});

test('it resolves label dedicated preview view when available', function () {
    $response = $this->get('/preview/label');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.label.index');
});

test('it resolves dialog dedicated preview view when available', function () {
    $response = $this->get('/preview/dialog');

    $response->assertOk()
        ->assertViewIs('preview.template')
        ->assertViewHas('previewView', 'preview.components.dialog.index');
});

test('it applies array based variants from preview json', function () {
    $response = $this->get('/preview/button?variant=secondary');

    $response->assertOk()
        ->assertViewHas('props', fn (array $props): bool => ($props['variant'] ?? null) === 'secondary');
});

test('it receives color scheme from webview query', function () {
    $response = $this->get('/preview/button?colorScheme=dark');

    $response->assertOk()
        ->assertViewHas('colorScheme', 'dark');
});
