<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ParameterController;
use \App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;

Route::get('/', [ProductsController::class, 'shop']);

Route::get('admin', function () {
    return view('admin');
});


Route::get('/home', function () {
    return view('home');
});


Route::get('/profile', function () {
    return view('profile');
});


Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/transaksi', function () {
    return view('transaksi');
});




//Route::middleware('auth')->group(function () {
//    Route::get('/dashboard', function () {
//        return view('welcome'); // create this view as needed
//    })->name('dashboard');
//});


// Register User
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Register Admin
Route::get('/register/admin', [AuthController::class, 'showRegistrationAdminForm'])->name('register-admin');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('register-admin.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin', function () {
    return view('admin');
});

Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard');



// Admin Page
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

Route::resource('/products', ProductsController::class);
Route::resource('/transaction', TransactionController::class);

//Route::get('/dashboard', function () {
//    return view('admin.dashboard');
//});

Route::prefix('admin')->group(function () {
    Route::resource('transactions', TransactionController::class);
});

Route::put('/admin/products/{id}', [ProductsController::class, 'update'])->name('products.update');

Route::get('/parameter', [ParameterController::class, 'index'])->name('parameter.index');
Route::post('/parameter', [ParameterController::class, 'store'])->name('parameter.store');
Route::put('/parameter/{type}/{id}', [ParameterController::class, 'update'])->name('parameter.update');
Route::delete('/parameter/{type}/{id}', [ParameterController::class, 'destroy'])->name('parameter.destroy');
