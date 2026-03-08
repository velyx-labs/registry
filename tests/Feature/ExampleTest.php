<?php

test('returns a successful response', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertJson([
            'name' => config('app.name'),
            'version' => config('app.version'),
        ]);
});
