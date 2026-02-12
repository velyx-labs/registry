<?php

use App\Http\Controllers\Api\ComponentController;
use Illuminate\Http\Request;
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
});