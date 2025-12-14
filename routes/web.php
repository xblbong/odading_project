<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicOrderController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $menus = Menu::where('is_available', true)->get();
    return view('welcome', compact('menus'));
});

Route::get('/transaksi', function () {
    return view('admin.transaksi.index');
});

Route::middleware('guest')->group(function () {
    // Menampilkan Form Login (GET)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    
    // Memproses Data Login (POST)
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Form Order
Route::get('/order', [PublicOrderController::class, 'index'])->name('order.index');
Route::post('/order', [PublicOrderController::class, 'store'])->name('order.store');

// Admin Routes (Harusnya diproteksi middleware auth, tapi ini basic dulu)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

        //user management
        Route::resource('users', UserController::class);
    });
});
