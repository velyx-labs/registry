<?php

declare(strict_types=1);

use App\Http\Controllers\Preview\InteractivePreviewController;
use App\Http\Controllers\Preview\PreviewComponentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Preview Routes
|--------------------------------------------------------------------------
|
| Routes for live component previews used in documentation.
|
*/

Route::prefix('preview')->group(function () {
    // Basic component preview with default props
    Route::get('/{component}', PreviewComponentController::class)
        ->name('preview.component');

    // Preview for interactive components (modal, drawer, alert, dropdown)
    Route::get('/interactive/{component}', InteractivePreviewController::class)
        ->name('preview.interactive');
});
