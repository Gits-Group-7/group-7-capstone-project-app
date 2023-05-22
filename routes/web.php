<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\CartOrderController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\OrderServiceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRatingsController;
use App\Http\Controllers\PromoBannerController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRatingsController;
use App\Http\Controllers\ShopRatingsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route Beranda Cuustomer
Route::get('/', [PageController::class, 'berandaPage'])->name('customer.beranda');
Route::get('/toko-print-shop', [PageController::class, 'storePage'])->name('customer.store');

// search route
Route::get('/search-product-and-service', [SearchController::class, 'search'])->name('customer.search');

// rating shop
Route::get('/ulasan-print-shop', [ShopRatingsController::class, 'index'])->name('customer.store.rating');
Route::post('/tambah-ulasan-toko/{id}', [ShopRatingsController::class, 'store'])->name('customer.rating.store');

Route::get('/detail-produk/{id}', [PageController::class, 'detailProduct'])->name('customer.product.detail');
Route::get('/detail-layanan-jasa/{id}', [PageController::class, 'detailService'])->name('customer.service.detail');
Route::post('/tambah-ulasan-produk/{product_id}/{user_id}', [ProductRatingsController::class, 'store'])->name('customer.rating.product');
Route::post('/tambah-ulasan-jasa/{service_id}/{user_id}', [ServiceRatingsController::class, 'store'])->name('customer.rating.service');

// route action logout customer & admin
Route::get('/logout', [PageController::class, "logout"])->name('logout.page');

// Halaman Cart
Route::get('/keranjang-produk-dan-pesanan-jasa', [CartOrderController::class, 'index'])->name('cart.index');

// Route Cart Product
Route::post('/add-to-cart-product-home/{user_id}/{product_id}', [CartProductController::class, 'store_home'])->name('cart.store.product.home');
Route::post('/add-to-cart-product-detail/{user_id}/{product_id}', [CartProductController::class, 'store_detail'])->name('cart.store.product.detail');

// Route Order Service
Route::post('/add-to-order-service-home/{user_id}/{service_id}', [OrderServiceController::class, 'store_home'])->name('order.store.service.home');
Route::post('/add-to-order-service-detail/{user_id}/{service_id}', [OrderServiceController::class, 'store_detail'])->name('order.store.service.detail');

// Route Transaction
Route::get('/manajemen-transaksi', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/tambah-transaksi', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/hapus-transaksi/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
Route::get('/proses-transaksi/{id}', [TransactionController::class, 'edit'])->name('customer.transaction.proccess'); // edit
Route::put('/update-transaksi/{id}', [TransactionController::class, 'update'])->name('customer.transaction.update'); // update (backend)
Route::get('/detail-transaksi/{id}', [TransactionController::class, 'show'])->name('customer.transaction.detail');

// Route::put('/keranjang/product-update/{id}', [CartProductController::class, 'update'])->name('cart.update');
// Route::get('/keranjang/product-delete/{id}', [CartProductController::class, 'destroy'])->name('cart.delete');

// Route Cart
// Route::get('/keranjang-produk-dan-pesanan-jasa', [CartController::class, 'index'])->name('cart.index');
// Route::post('/keranjang/product-store/{id}', [CartController::class, 'store'])->name('cart.store');c
// Route::put('/keranjang/product-update/{id}', [CartController::class, 'update'])->name('cart.update');
// Route::get('/keranjang/product-delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

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

    // update profile admin
    Route::get('/admin/{id}/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
    Route::put('/admin/{id}/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // Route Promo Banner
    Route::get('/admin/daftar-promo-banner', [PromoBannerController::class, 'index'])->name('promo.banner.index');
    Route::get('/admin/tambah-promo-banner', [PromoBannerController::class, 'create'])->name('promo.banner.create');
    Route::get('/admin/edit-promo-banneer/{id}', [PromoBannerController::class, 'edit'])->name('promo.banner.edit');
    Route::get('/admin/hapus-promo-banner/{id}', [PromoBannerController::class, 'destroy'])->name('promo.banner.destroy');
    Route::post('/admin/simpan-promo-banner', [PromoBannerController::class, 'store'])->name('promo.banner.store');
    Route::put('/admin/ubah-promo-banner/{id}', [PromoBannerController::class, 'update'])->name('promo.banner.update');

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
    // update profile customer
    Route::get('/customer/{id}/profile', [CustomerProfileController::class, 'show'])->name('customer.profile');
    Route::put('/customer/{id}/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');

    Route::get('/cusomer/{id}/daftar-transaksi', [PageController::class, 'listTransaction'])->name('customer.transaction.list');
    Route::get('/cusomer/{id}/daftar-order', [PageController::class, 'listOrder'])->name('customer.order.list');
    Route::get('/cusomer/{id}/transaksi-produk', [PageController::class, 'transactionProduct'])->name('customer.transaction.product');
    Route::get('/cusomer/{id}/order-jasa', [PageController::class, 'orderService'])->name('customer.order.service');
});
