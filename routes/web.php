<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\PublicOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/transaksi', function () {
    return view('admin.transaksi.index');
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

     // Route Resource otomatis membuat (index, store, update, destroy)
    Route::resource('/menu', MenuController::class)->except(['create', 'edit', 'show']);

    // ROUTE BARU: TRANSAKSI
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/{id}/confirm', [TransactionController::class, 'confirmPayment'])->name('transaksi.confirm');
});
