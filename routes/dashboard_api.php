<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Api\AdminApiController;
use App\Http\Controllers\Dashboard\Api\ArticlesApiController;
use App\Http\Controllers\Dashboard\Api\CollectionsApiController;
use App\Http\Controllers\Dashboard\Api\EntriesApiController;
use App\Http\Controllers\Dashboard\Api\FieldsApiController;
use App\Http\Controllers\Dashboard\Api\SectionsApiController;
use App\Http\Controllers\Dashboard\Api\FieldGroupsApiController;
use App\Http\Controllers\Dashboard\Api\MediaApiController;
use App\Http\Controllers\Dashboard\Api\RevisionsApiController;

Route::middleware(['auth:dashboard'])->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('users', [AdminApiController::class, 'index'])->name('dashboard.api.users.index');
        Route::post('users', [AdminApiController::class, 'store'])->name('dashboard.api.users.store');
        Route::put('users/{id}', [AdminApiController::class, 'update'])->name('dashboard.api.users.update');
        Route::delete('users/{id}', [AdminApiController::class, 'destroy'])->name('dashboard.api.users.destroy');

        Route::get('collections', [CollectionsApiController::class, 'index'])->name('dashboard.api.collections.index');
        Route::post('collections', [CollectionsApiController::class, 'store'])->name('dashboard.api.collections.store');
        Route::get('collections/{collection}', [CollectionsApiController::class, 'show'])->name('dashboard.api.collections.show');
        Route::put('collections/{collection}', [CollectionsApiController::class, 'update'])->name('dashboard.api.collections.update');
        Route::delete('collections/{collection}', [CollectionsApiController::class, 'destroy'])->name('dashboard.api.collections.destroy');
        Route::post('collections/{id}/restore', [CollectionsApiController::class, 'restore'])->name('dashboard.api.collections.restore');
        Route::post('collections/{id}/duplicate', [CollectionsApiController::class, 'duplicate'])->name('dashboard.api.collections.duplicate');

        Route::get('entries', [EntriesApiController::class, 'index'])->name('dashboard.api.entries.index');
        Route::post('entries', [EntriesApiController::class, 'store'])->name('dashboard.api.entries.store');
        Route::put('entries/{id}', [EntriesApiController::class, 'update'])->name('dashboard.api.entries.update');
        Route::delete('entries/{id}', [EntriesApiController::class, 'destroy'])->name('dashboard.api.entries.destroy');

        Route::get('fields', [FieldsApiController::class, 'index'])->name('dashboard.api.fields.index');
        Route::post('fields', [FieldsApiController::class, 'store'])->name('dashboard.api.fields.store');
        Route::get('fields/{field}', [FieldsApiController::class, 'show'])->name('dashboard.api.fields.show');
        Route::put('fields/{field}', [FieldsApiController::class, 'update'])->name('dashboard.api.fields.update');
        Route::delete('fields/{field}', [FieldsApiController::class, 'destroy'])->name('dashboard.api.fields.destroy');
        Route::get('fields/types', [FieldsApiController::class, 'getFieldTypes'])->name('dashboard.api.fields.types');

        Route::get('sections', [SectionsApiController::class, 'index'])->name('dashboard.api.sections.index');
        Route::post('sections', [SectionsApiController::class, 'store'])->name('dashboard.api.sections.store');
        Route::put('sections/{id}', [SectionsApiController::class, 'update'])->name('dashboard.api.sections.update');
        Route::delete('sections/{id}', [SectionsApiController::class, 'destroy'])->name('dashboard.api.sections.destroy');

        Route::get('field-groups', [FieldGroupsApiController::class, 'index'])->name('dashboard.api.field-groups.index');
        Route::post('field-groups', [FieldGroupsApiController::class, 'store'])->name('dashboard.api.field-groups.store');
        Route::put('field-groups/{id}', [FieldGroupsApiController::class, 'update'])->name('dashboard.api.field-groups.update');
        Route::delete('field-groups/{id}', [FieldGroupsApiController::class, 'destroy'])->name('dashboard.api.field-groups.destroy');

        Route::get('media', [MediaApiController::class, 'index'])->name('dashboard.api.media.index');
        Route::post('media', [MediaApiController::class, 'store'])->name('dashboard.api.media.store');
        Route::put('media/{id}', [MediaApiController::class, 'update'])->name('dashboard.api.media.update');
        Route::delete('media/{id}', [MediaApiController::class, 'destroy'])->name('dashboard.api.media.destroy');
        Route::get('media/{id}/download', [MediaApiController::class, 'download'])->name('dashboard.api.media.download');

        Route::get('revisions', [RevisionsApiController::class, 'index'])->name('dashboard.api.revisions.index');
        Route::get('revisions/{id}', [RevisionsApiController::class, 'show'])->name('dashboard.api.revisions.show');
        Route::post('revisions/{id}/restore', [RevisionsApiController::class, 'restore'])->name('dashboard.api.revisions.restore');
        Route::get('revisions/compare/{id1}/{id2}', [RevisionsApiController::class, 'compare'])->name('dashboard.api.revisions.compare');
    });
});
