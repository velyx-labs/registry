<?php

use App\Http\Controllers\Web\PreviewController;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Component preview routes
Route::prefix('components')->name('components.')->group(function () {
    Route::get('/', [PreviewController::class, 'index'])->name('index');
    Route::get('/{name}', [PreviewController::class, 'show'])->name('show');
    Route::get('/{name}/{version}', [PreviewController::class, 'show'])->name('version');
    Route::get('/{name}/{version}/render', [PreviewController::class, 'render'])->name('render');
});