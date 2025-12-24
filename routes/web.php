<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-web', function () {
    return 'Web route working';
});

Route::prefix('dashboard')->group(function () {
    Route::get('/login', [App\Http\Controllers\Dashboard\AuthController::class, 'index'])->name('dashboard.login');
    Route::post('/login', [App\Http\Controllers\Dashboard\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Dashboard\AuthController::class, 'logout'])->name('dashboard.logout');

    // Dashboard routes
    Route::middleware(['auth:dashboard'])->group(function () {
        Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard.index');
        
        // Include dashboard routes with proper prefix
        require __DIR__.'/dashboard.php';
    });
});

// Fallback login route
Route::get('/login', function () {
    return redirect()->route('dashboard.login');
})->name('login');
