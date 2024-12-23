<?php


use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


// HASRUD ADMIN PAKE LARAVEL STANCCCCCCTRUMMMM BLOM
Route::prefix('admin')->name('admin.')->group(function() {
    // Login
    Route::post('/login', [AdminController::class, 'login'])->name('login');
    
    // Register
    Route::post('/register', [AdminController::class, 'register'])->name('register');
    
    // Lupa password
    Route::post('/forgot-password', [AdminController::class, 'sendResetLinkEmail'])->name('forgot-password');
    
    // Reset password
    Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('reset-password');
    
    // Logout
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});