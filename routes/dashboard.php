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
        Route::resource('collections', CollectionsController::class)->names([
            'index' => 'dashboard.collections.index',
            'create' => 'dashboard.collections.create',
            'store' => 'dashboard.collections.store',
            'show' => 'dashboard.collections.show',
            'edit' => 'dashboard.collections.edit',
            'update' => 'dashboard.collections.update',
            'destroy' => 'dashboard.collections.destroy',
        ]);
    });

    // Entries management (admin, editor, and author)
    Route::middleware(['role:admin,editor,author'])->group(function () {
        Route::resource('entries', EntriesController::class);
    });
});
