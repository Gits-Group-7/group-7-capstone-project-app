<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route Beranda Cuustomer
Route::get('/', [PageController::class, 'berandaPage'])->name('customer.beranda');

// Route Transaction
Route::get('/manajemen-transaksi', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/tambah-transaksi', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/hapus-transaksi/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
Route::get('/proses-transaksi/{id}', [TransactionController::class, 'edit'])->name('customer.transaction.proccess'); // edit
Route::put('/update-transaksi/{id}', [TransactionController::class, 'update'])->name('customer.transaction.update'); // update (backend)
Route::get('/detail-transaksi/{id}', [TransactionController::class, 'show'])->name('customer.transaction.detail');

// route action logout customer & admin
Route::get('/logout', [PageController::class, "logout"])->name('logout.page');

// Route Cart
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/product-store/{id}', [CartController::class, 'store'])->name('cart.store');
Route::put('/keranjang/product-update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/keranjang/product-delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

// route for guest user
Route::middleware(['guest'])->group(function () {
    // Route Auth Admin
    Route::get('/admin-login', [AuthAdminController::class, "login"])->name('admin.login');
    Route::get('/admin-register', [AuthAdminController::class, "register"])->name('admin.register');

    // Route Action Auth Admin
    Route::post('/admin-register', [AuthAdminController::class, "doRegister"])->name('admin.do.register');
    Route::post('/admin-login', [AuthAdminController::class, "doLogin"])->name('admin.do.login');

    // Route Auth Customer
    Route::get('/customer-login', [AuthCustomerController::class, "login"])->name('customer.login');
    Route::get('/customer-register', [AuthCustomerController::class, "register"])->name('customer.register');

    // Route Action Auth Customer
    Route::post('/customer-register', [AuthCustomerController::class, "doRegister"])->name('customer.do.register');
    Route::post('/customer-login', [AuthCustomerController::class, "doLogin"])->name('customer.do.login');
});

// special route for role admin`
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', [AuthAdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/daftar-customer', [PageController::class, 'customer'])->name('admin.customer');
    Route::get('/admin/daftar-transaksi-order', [PageController::class, 'transactionOrder'])->name('admin.transaction.order');
    Route::get('/admin/daftar-transaksi-details', [PageController::class, 'transactionDetails'])->name('admin.transaction.details');
    Route::get('/admin/daftar-order-details', [PageController::class, 'orderDetails'])->name('admin.order.details');

    // update profil admin
    Route::get('/admin/profile/{id}', [PageController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile/{id}', [PageController::class, 'update'])->name('admin.profile.update');

    // Route Category
    Route::get('/admin/daftar-kategori', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/admin/tambah-kategori', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/admin/edit-kategori/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/admin/hapus-kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/admin/simpan-kategori', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/admin/ubah-kategori/{id}', [CategoryController::class, 'update'])->name('category.update');

    // Route Produk
    Route::get('/admin/daftar-produk', [ProductController::class, 'index'])->name('product.index');
    Route::get('/admin/tambah-produk', [ProductController::class, 'create'])->name('product.create');
    Route::get('/admin/edit-produk/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/admin/hapus-produk/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/admin/simpan-produk', [ProductController::class, 'store'])->name('product.store');
    Route::put('/admin/ubah-produk/{id}', [ProductController::class, 'update'])->name('product.update');

    // Route Jasa
    Route::get('/admin/daftar-jasa', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/admin/tambah-jasa', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/admin/edit-jasa/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::get('/admin/hapus-jasa/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::post('/admin/simpan-jasa', [ServiceController::class, 'store'])->name('service.store');
    Route::put('/admin/ubah-jasa/{id}', [ServiceController::class, 'update'])->name('service.update');

    // Route Template Page (route tidak dipakai)
    Route::get('/admin-button', [PageController::class, 'buttonPage'])->name('admin.button');
    Route::get('/admin-form', [PageController::class, 'formPage'])->name('admin.form');
    Route::get('/admin-chart', [PageController::class, 'chartPage'])->name('admin.chart');
});

// special route for role customer
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer/profile', [AuthCustomerController::class, 'profile'])->name('customer.profile');
});
