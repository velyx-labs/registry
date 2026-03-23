<?php

use App\Http\Controllers\Api\ComponentController;
use App\Http\Controllers\Api\InstallationController;
use App\Http\Controllers\Api\PreviewSourceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Registry API v1
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Registry API v1 endpoints
Route::prefix('v1')->group(function () {
    // Component endpoints
    Route::get('/components', [ComponentController::class, 'index']);
    Route::get('/components/{name}', [ComponentController::class, 'show']);
    Route::get('/components/{name}/versions', [ComponentController::class, 'versions']);
    Route::get('/previews/{component}/source', PreviewSourceController::class);

    // Installation tracking endpoints
    Route::prefix('installations')->group(function () {
        Route::get('/', [InstallationController::class, 'index']);
        Route::post('/', [InstallationController::class, 'store']);
        Route::get('/stats', [InstallationController::class, 'stats']);
        Route::get('/popular', [InstallationController::class, 'popular']);
        Route::get('/trends', [InstallationController::class, 'trends']);
        Route::get('/projects', [InstallationController::class, 'projects']);
        Route::get('/projects/{project}', [InstallationController::class, 'projectHistory']);
        Route::get('/components/{component}', [InstallationController::class, 'component']);
    });
});
