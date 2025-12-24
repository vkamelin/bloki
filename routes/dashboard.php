<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\ArticlesController;
use App\Http\Controllers\Dashboard\CollectionsController;
use App\Http\Controllers\Dashboard\EntriesController;
use App\Http\Controllers\Dashboard\SectionsController;
use App\Http\Controllers\Dashboard\FieldGroupsController;
use App\Http\Controllers\Dashboard\FieldsController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\RevisionsController;
use App\Http\Controllers\Dashboard\AuthController;

// Authentication routes (no auth middleware)
Route::get('/login', [AuthController::class, 'index'])->name('dashboard.login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');

Route::middleware(['auth:dashboard'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Users management (admin only)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('users', [UsersController::class, 'index'])->name('dashboard.users.index');
        Route::get('users/create', [UsersController::class, 'create'])->name('dashboard.users.create');
        Route::post('users', [UsersController::class, 'store'])->name('dashboard.users.store');
        Route::get('users/{user}', [UsersController::class, 'show'])->name('dashboard.users.show');
        Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('dashboard.users.edit');
        Route::put('users/{user}', [UsersController::class, 'update'])->name('dashboard.users.update');
        Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('dashboard.users.destroy');
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
        Route::post('collections/{id}/restore', [CollectionsController::class, 'restore'])->name('dashboard.collections.restore');
        Route::post('collections/{id}/duplicate', [CollectionsController::class, 'duplicate'])->name('dashboard.collections.duplicate');
        Route::delete('collections/{id}/force-delete', [CollectionsController::class, 'forceDelete'])->name('dashboard.collections.forceDelete');
        Route::get('collections/import', [CollectionsController::class, 'import'])->name('dashboard.collections.import');
        Route::post('collections/import', [CollectionsController::class, 'importFile'])->name('dashboard.collections.importFile');
        Route::get('collections/export', [CollectionsController::class, 'export'])->name('dashboard.collections.export');
        Route::post('collections/export', [CollectionsController::class, 'exportFile'])->name('dashboard.collections.exportFile');
    });

    // Sections management (admin and editor)
    Route::middleware(['role:admin,editor'])->group(function () {
        Route::get('sections', [SectionsController::class, 'index'])->name('dashboard.sections.index');
        Route::get('sections/create', [SectionsController::class, 'create'])->name('dashboard.sections.create');
        Route::post('sections', [SectionsController::class, 'store'])->name('dashboard.sections.store');
        Route::get('sections/{id}', [SectionsController::class, 'show'])->name('dashboard.sections.show');
        Route::get('sections/{id}/edit', [SectionsController::class, 'edit'])->name('dashboard.sections.edit');
        Route::put('sections/{id}', [SectionsController::class, 'update'])->name('dashboard.sections.update');
        Route::delete('sections/{id}', [SectionsController::class, 'destroy'])->name('dashboard.sections.destroy');
        Route::post('sections/{id}/restore', [SectionsController::class, 'restore'])->name('dashboard.sections.restore');
        Route::post('sections/reorder', [SectionsController::class, 'reorder'])->name('dashboard.sections.reorder');
    });

    // Field Groups management (admin and editor)
    Route::middleware(['role:admin,editor'])->group(function () {
        Route::get('field-groups', [FieldGroupsController::class, 'index'])->name('dashboard.field-groups.index');
        Route::get('field-groups/create', [FieldGroupsController::class, 'create'])->name('dashboard.field-groups.create');
        Route::post('field-groups', [FieldGroupsController::class, 'store'])->name('dashboard.field-groups.store');
        Route::get('field-groups/{id}', [FieldGroupsController::class, 'show'])->name('dashboard.field-groups.show');
        Route::get('field-groups/{id}/edit', [FieldGroupsController::class, 'edit'])->name('dashboard.field-groups.edit');
        Route::put('field-groups/{id}', [FieldGroupsController::class, 'update'])->name('dashboard.field-groups.update');
        Route::delete('field-groups/{id}', [FieldGroupsController::class, 'destroy'])->name('dashboard.field-groups.destroy');
        Route::post('field-groups/{id}/restore', [FieldGroupsController::class, 'restore'])->name('dashboard.field-groups.restore');
    });

    // Fields management (admin and editor)
    Route::middleware(['role:admin,editor'])->group(function () {
        Route::get('fields', [FieldsController::class, 'index'])->name('dashboard.fields.index');
        Route::get('fields/create', [FieldsController::class, 'create'])->name('dashboard.fields.create');
        Route::post('fields', [FieldsController::class, 'store'])->name('dashboard.fields.store');
        Route::get('fields/{id}', [FieldsController::class, 'show'])->name('dashboard.fields.show');
        Route::get('fields/{id}/edit', [FieldsController::class, 'edit'])->name('dashboard.fields.edit');
        Route::put('fields/{id}', [FieldsController::class, 'update'])->name('dashboard.fields.update');
        Route::delete('fields/{id}', [FieldsController::class, 'destroy'])->name('dashboard.fields.destroy');
        Route::post('fields/{id}/restore', [FieldsController::class, 'restore'])->name('dashboard.fields.restore');
    });

    // Entries management (admin, editor, and author)
    Route::middleware(['role:admin,editor,author'])->group(function () {
        Route::get('entries', [EntriesController::class, 'index'])->name('dashboard.entries.index');
        Route::get('entries/create', [EntriesController::class, 'create'])->name('dashboard.entries.create');
        Route::post('entries', [EntriesController::class, 'store'])->name('dashboard.entries.store');
        Route::get('entries/{id}', [EntriesController::class, 'show'])->name('dashboard.entries.show');
        Route::get('entries/{id}/edit', [EntriesController::class, 'edit'])->name('dashboard.entries.edit');
        Route::put('entries/{id}', [EntriesController::class, 'update'])->name('dashboard.entries.update');
        Route::delete('entries/{id}', [EntriesController::class, 'destroy'])->name('dashboard.entries.destroy');
        Route::post('entries/{id}/restore', [EntriesController::class, 'restore'])->name('dashboard.entries.restore');
        Route::get('entries/{id}/preview', [EntriesController::class, 'preview'])->name('dashboard.entries.preview');
        Route::post('entries/{id}/publish', [EntriesController::class, 'publish'])->name('dashboard.entries.publish');
        Route::post('entries/{id}/unpublish', [EntriesController::class, 'unpublish'])->name('dashboard.entries.unpublish');
    });

    // Media management (admin, editor, and author)
    Route::middleware(['role:admin,editor,author'])->group(function () {
        Route::get('media', [MediaController::class, 'index'])->name('dashboard.media.index');
        Route::get('media/upload', [MediaController::class, 'upload'])->name('dashboard.media.upload');
        Route::post('media', [MediaController::class, 'store'])->name('dashboard.media.store');
        Route::get('media/{id}', [MediaController::class, 'show'])->name('dashboard.media.show');
        Route::get('media/{id}/edit', [MediaController::class, 'edit'])->name('dashboard.media.edit');
        Route::put('media/{id}', [MediaController::class, 'update'])->name('dashboard.media.update');
        Route::delete('media/{id}', [MediaController::class, 'destroy'])->name('dashboard.media.destroy');
        Route::post('media/{id}/restore', [MediaController::class, 'restore'])->name('dashboard.media.restore');
        Route::get('media/{id}/download', [MediaController::class, 'download'])->name('dashboard.media.download');
    });

    // Revisions management (admin, editor, and author)
    Route::middleware(['role:admin,editor,author'])->group(function () {
        Route::get('revisions', [RevisionsController::class, 'index'])->name('dashboard.revisions.index');
        Route::get('revisions/{id}', [RevisionsController::class, 'show'])->name('dashboard.revisions.show');
        Route::post('revisions/{id}/restore', [RevisionsController::class, 'restore'])->name('dashboard.revisions.restore');
        Route::get('revisions/compare/{id1}/{id2}', [RevisionsController::class, 'compare'])->name('dashboard.revisions.compare');
    });
});
