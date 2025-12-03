<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\PublicOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login')->middleware('guest'); 
    

// Form Order
Route::get('/order', [PublicOrderController::class, 'index'])->name('order.index');
Route::post('/order', [PublicOrderController::class, 'store'])->name('order.store');

// Admin Routes (Harusnya diproteksi middleware auth, tapi ini basic dulu)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/order/{id}/approve', [AdminDashboardController::class, 'approve'])->name('admin.approve');

    // Resource untuk Produk (CRUD)
    Route::resource('products', AdminProductController::class);
});
