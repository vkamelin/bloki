<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/login', [App\Http\Controllers\Dashboard\AuthController::class, 'index'])->name('dashboard.login');
    Route::post('/login', [App\Http\Controllers\Dashboard\AuthController::class, 'login']);
});
