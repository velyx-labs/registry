<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (): array {
    return [
        'name' => config('app.name'),
        'version' => config('app.version', app()->version()),
    ];
})->name('home');
