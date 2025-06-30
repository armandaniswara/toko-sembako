<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Konfigurasi rute yang bersih dan terstruktur dengan benar.
*/

// --- RUTE PUBLIK & PENGGUNA ---
Route::get('/', [ProductsController::class, 'shop'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Rute Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Rute Riwayat Transaksi User
    Route::get('/pesanan', [OrderController::class, 'index'])->name('order.index');
    Route::get('/pesanan/sukses/{invoice}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/pesanan/{invoice}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/bayar/{invoice}', [OrderController::class, 'payment'])->name('order.payment');
    // Rute Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');

// Rute Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/now', [CheckoutController::class, 'checkoutNow'])->name('checkout.now');
    Route::post('/checkout/selected', [CheckoutController::class, 'checkoutSelected'])->name('checkout.selected');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/pesanan/sukses/{invoice}', [App\Http\Controllers\OrderController::class, 'success'])->name('order.success');
    Route::get('/product-detail/{id}', [ProductsController::class, 'detail'])->name('product-detail');
});

// --- RUTE AUTENTIKASI ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');


// --- RUTE ADMIN ---
// Route::middleware(['auth', 'admin'])->group(function () {
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Tambahkan semua rute admin lainnya di sini
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/user', UserController::class)->only(['index', 'destroy']);
    Route::resource('/products', ProductsController::class);
    Route::get('/transaction/print-all', [TransactionController::class, 'printAll'])->name('transaction.printAll');
    Route::get('/transaction/detail/{invoice}', [TransactionController::class, 'detail'])->name('transaction.detail');
    Route::resource('transaction', TransactionController::class);
    Route::get('parameter', [ParameterController::class, 'index'])->name('parameter.index');
    Route::post('parameter', [ParameterController::class, 'store'])->name('parameter.store');
    Route::put('parameter/{type}/{id}', [ParameterController::class, 'update'])->name('parameter.update');
    Route::delete('parameter/{type}/{id}', [ParameterController::class, 'destroy'])->name('parameter.destroy');

    // Contoh: Route::resource('products', ProductsController::class);
});


// ==================================================================
// PERBAIKAN UTAMA ADA DI SINI
// ==================================================================
// Rute custom yang spesifik diletakkan SEBELUM resource.

// Route::resource akan secara otomatis membuat rute untuk:
// - index (transaction.index)
// - create (transaction.create)
// - store (transaction.store)
// - show (transaction.show) <-- INI YANG ANDA BUTUHKAN
// - edit (transaction.edit)
// - update (transaction.update)
// - destroy (transaction.destroy)


// });
