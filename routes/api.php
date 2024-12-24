<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\CartController;

// Rute API untuk Login dan Registrasi
Route::post('/login', [AdminController::class, 'login'])->name('api.login'); // Login user
Route::post('/register', [AdminController::class, 'register'])->name('api.register'); // Registrasi user
Route::post('/logout', [AdminController::class, 'logout'])->name('api.logout'); // Logout user

// Rute API untuk Forgot Password
Route::post('/forgot-password/send', [AdminController::class, 'sendResetEmail'])->name('api.password.sendEmail'); // Kirim email reset password
Route::post('/forgot-password/reset', [AdminController::class, 'resetPassword'])->name('api.password.resetPassword'); // Reset password

// Rute API untuk Admin
Route::post('admin/login', [AuthenticatedSessionController::class, 'store'])->name('api.admin.login'); // Login admin
Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:admin')->name('api.admin.logout'); // Logout admin

// Rute API untuk Produk
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index'); // Daftar produk
Route::get('/products/{id}', [ProductController::class, 'show'])->name('api.products.show'); // Detail produk
Route::middleware('auth:admin')->group(function () {
    Route::post('/products', [ProductController::class, 'store'])->name('api.products.store'); // Tambah produk
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('api.products.update'); // Update produk
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('api.products.destroy'); // Hapus produk
});

// Rute API untuk Keranjang Belanja
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'showCart'])->name('api.cart.index'); // Tampilkan keranjang
    Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('api.cart.add'); // Tambah ke keranjang
    Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('api.cart.update'); // Update jumlah
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('api.cart.remove'); // Hapus dari keranjang
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('api.cart.clear'); // Hapus semua keranjang
    Route::get('/checkout', [CartController::class, 'checkout'])->name('api.cart.checkout'); // Checkout
});

// Rute API untuk Produk di Halaman Utama
Route::get('/index', [ProductController::class, 'indexuser'])->name('api.produk.index'); // Produk tanpa login
Route::get('/produk', [ProductController::class, 'indexuser'])->name('api.dashboard.index'); // Produk untuk dashboard