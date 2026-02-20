<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocsController;

Route::livewire('/', 'pages::landing')->name('home');

// Documentation routes
Route::prefix('docs')->group(function () {
    Route::get('/', [DocsController::class, 'show'])->name('docs.show');
    Route::get('/{page}', [DocsController::class, 'show'])->name('docs.show.page');
    Route::get('/components/{component}', [DocsController::class, 'component'])->name('components.show');
});
