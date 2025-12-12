<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\ArticlesController;
use App\Http\Controllers\Dashboard\CollectionsController;
use App\Http\Controllers\Dashboard\EntriesController;

Route::middleware(['auth:dashboard'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('users', UsersController::class);
    Route::resource('articles', ArticlesController::class);
    Route::resource('collections', CollectionsController::class);
    Route::resource('entries', EntriesController::class);
});