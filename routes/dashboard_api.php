<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Api\UsersApiController;
use App\Http\Controllers\Dashboard\Api\ArticlesApiController;
use App\Http\Controllers\Dashboard\Api\CollectionsApiController;
use App\Http\Controllers\Dashboard\Api\EntriesApiController;
use App\Http\Controllers\Dashboard\Api\FieldsApiController;

Route::middleware(['auth:dashboard'])->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/users', [UsersApiController::class, 'index']);
        Route::post('/users', [UsersApiController::class, 'store']);
        Route::put('/users/{id}', [UsersApiController::class, 'update']);
        Route::delete('/users/{id}', [UsersApiController::class, 'destroy']);
        
        Route::get('/articles', [ArticlesApiController::class, 'index']);
        Route::post('/articles', [ArticlesApiController::class, 'store']);
        Route::put('/articles/{id}', [ArticlesApiController::class, 'update']);
        Route::delete('/articles/{id}', [ArticlesApiController::class, 'destroy']);
        
        Route::get('/collections', [CollectionsApiController::class, 'index']);
        Route::post('/collections', [CollectionsApiController::class, 'store']);
        Route::put('/collections/{id}', [CollectionsApiController::class, 'update']);
        Route::delete('/collections/{id}', [CollectionsApiController::class, 'destroy']);
        
        Route::get('/entries', [EntriesApiController::class, 'index']);
        Route::post('/entries', [EntriesApiController::class, 'store']);
        Route::put('/entries/{id}', [EntriesApiController::class, 'update']);
        Route::delete('/entries/{id}', [EntriesApiController::class, 'destroy']);
        
        Route::get('/fields', [FieldsApiController::class, 'index']);
        Route::post('/fields', [FieldsApiController::class, 'store']);
        Route::get('/fields/{field}', [FieldsApiController::class, 'show']);
        Route::put('/fields/{field}', [FieldsApiController::class, 'update']);
        Route::delete('/fields/{field}', [FieldsApiController::class, 'destroy']);
        Route::get('/fields/types', [FieldsApiController::class, 'getFieldTypes']);
    });
});