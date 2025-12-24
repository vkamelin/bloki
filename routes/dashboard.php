<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\ArticlesController;
use App\Http\Controllers\Dashboard\CollectionsController;
use App\Http\Controllers\Dashboard\EntriesController;

Route::middleware(['auth:dashboard'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    // Users management (admin only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UsersController::class);
    });

    // Articles management (admin and editor)
    Route::middleware(['role:admin,editor'])->group(function () {
        Route::resource('articles', ArticlesController::class);
    });

    // Collections management (admin and editor)
    Route::middleware(['role:admin,editor'])->group(function () {
        Route::get('collections', [CollectionsController::class, 'index'])->name('dashboard.collections.index');
        Route::get('collections/create', [CollectionsController::class, 'create'])->name('dashboard.collections.create');
        Route::post('collections', [CollectionsController::class, 'store'])->name('dashboard.collections.store');
        Route::get('collections/{id}', [CollectionsController::class, 'show'])->name('dashboard.collections.show');
        Route::get('collections/{id}/edit', [CollectionsController::class, 'edit'])->name('dashboard.collections.edit');
        Route::put('collections/{id}', [CollectionsController::class, 'update'])->name('dashboard.collections.update');
        Route::delete('collections/{id}', [CollectionsController::class, 'destroy'])->name('dashboard.collections.destroy');
        Route::get('collections/import', [CollectionsController::class, 'import'])->name('dashboard.collections.import');
        Route::post('collections/import', [CollectionsController::class, 'importFile'])->name('dashboard.collections.importFile');
        Route::get('collections/export', [CollectionsController::class, 'export'])->name('dashboard.collections.export');
        Route::post('collections/export', [CollectionsController::class, 'exportFile'])->name('dashboard.collections.exportFile');
    });

    // Entries management (admin, editor, and author)
    Route::middleware(['role:admin,editor,author'])->group(function () {
        Route::resource('entries', EntriesController::class);
        Route::get('entries', [EntriesController::class, 'index'])->name('dashboard.entries.index');
        Route::get('entries/create', [EntriesController::class, 'show'])->name('dashboard.entries.show');
        Route::post('entries', [EntriesController::class, 'preview'])->name('dashboard.entries.preview');
    });
});
