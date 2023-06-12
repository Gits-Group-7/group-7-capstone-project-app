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
use App\Http\Controllers\TransactionOrderController;
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

    // Manajemen Pesanan (Konfirmasi & Update Tracking)
    Route::get('/admin/manage-daftar-transaksi', [PageController::class, 'manage_transaction'])->name('admin.manage.transaction');
    Route::get('/admin/manage-daftar-order', [PageController::class, 'manage_order'])->name('admin.manage.order');
    Route::put('/admin/manage-tracking-transaction-product/{transaction_order_id}', [TransactionOrderController::class, 'update_tracking_product'])->name('admin.update.tracking.product');
    Route::put('/admin/manage-tracking-order-service/{transaction_order_id}', [TransactionOrderController::class, 'update_tracking_service'])->name('admin.update.tracking.service');

    // route delete track log
    Route::put('/admin/clearing-transaction-product-logs/{transaction_order_id}', [TransactionOrderController::class, 'clearing_transaction_product'])->name('admin.clear.transaction.product');
    Route::put('/admin/clearing-order-service-logs/{transaction_order_id}', [TransactionOrderController::class, 'clearing_order_service'])->name('admin.clear.order.service');

    // konfirmasi pesanan
    Route::put('/admin/konfirmasi-transaksi-produk/{transaction_order_id}', [TransactionOrderController::class, 'confirm_transaction'])->name('admin.manage.transaction.confirm');
    Route::put('/admin/konfirmasi-order-jasa/{transaction_order_id}', [TransactionOrderController::class, 'confirm_order'])->name('admin.manage.order.confirm');

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
});

// special route for role customer
Route::middleware(['auth', 'customer'])->group(function () {
    // update profile customer
    Route::get('/customer/{id}/profile', [CustomerProfileController::class, 'show'])->name('customer.profile');
    Route::put('/customer/{id}/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');

    // Halaman Cart
    Route::get('/keranjang-produk-dan-pesanan-jasa', [CartOrderController::class, 'index'])->name('cart.index');

    // Route Cart Product
    Route::post('/add-to-cart-product-home/{user_id}/{product_id}', [CartProductController::class, 'store_home'])->name('cart.store.product.home');
    Route::post('/add-to-cart-product-detail/{user_id}/{product_id}', [CartProductController::class, 'store_detail'])->name('cart.store.product.detail');
    Route::put('/update-cart-product/{product_id}', [CartProductController::class, 'update'])->name('cart.update.product');
    Route::get('/delete-cart-product/{product_id}', [CartProductController::class, 'destroy'])->name('cart.delete.product');

    // Route Order Service
    Route::post('/add-to-order-service-home/{user_id}/{service_id}', [OrderServiceController::class, 'store_home'])->name('order.store.service.home');
    Route::post('/add-to-order-service-detail/{user_id}/{service_id}', [OrderServiceController::class, 'store_detail'])->name('order.store.service.detail');
    Route::put('/update-order-service/{service_id}', [OrderServiceController::class, 'update'])->name('order.update.service');
    Route::get('/delete-order-service/{service_id}', [OrderServiceController::class, 'destroy'])->name('order.delete.service');

    // Route Transaction Order (Product & Service)
    Route::get('/daftar-transaksi-order', [TransactionOrderController::class, 'index'])->name('transaction.order.customer.list');
    Route::get('/tambah-transaksi-product/{user_id}', [TransactionOrderController::class, 'transaction_store_product'])->name('transaction.order.product.store');
    Route::get('/tambah-order-service/{user_id}', [TransactionOrderController::class, 'order_store_service'])->name('transaction.order.service.store');
    Route::get('/hapus-transaksi-order/{transaction_order_id}', [TransactionOrderController::class, 'destroy'])->name('transaction.order.destroy');

    // Route Transaction & Order Checkout (Product & Service)
    Route::get('/detail-transaksi-produk/{transaction_id}', [TransactionOrderController::class, 'show_transaction_product'])->name('transaction.order.show_transaction_product');
    Route::put('/checkout-transaksi-produk/{transaction_id}', [TransactionOrderController::class, 'update_transaction_product'])->name('transaction.order.checkout_transaction_product'); // checkout product (update)
    Route::get('/detail-order-jasa/{order_id}', [TransactionOrderController::class, 'show_order_service'])->name('transaction.order.show_order_service');
    Route::put('/checkout-order-jasa/{order_id}', [TransactionOrderController::class, 'update_order_service'])->name('transaction.order.checkout_order_jasa'); // checkout service (update)
    Route::put('/upload-prof-transaction-order-payment/{transaction_order_id}', [TransactionOrderController::class, 'upload_transaction_order_payment'])->name('transaction.order.upload_transaction_order_payment'); // upload transaction order payment (product & service)

    Route::get('/customer/{id}/daftar-transaksi', [PageController::class, 'listTransaction'])->name('customer.transaction.list');
    Route::get('/customer/{id}/daftar-order', [PageController::class, 'listOrder'])->name('customer.order.list');
    Route::get('/customer/{id}/transaksi-produk', [PageController::class, 'transactionProduct'])->name('customer.transaction.product');
    Route::get('/customer/{id}/order-jasa', [PageController::class, 'orderService'])->name('customer.order.service');

    // route completing transaction order customer
    Route::put('/customer/transaction-product-completed/{transaction_order_id}', [CustomerProfileController::class, 'transaction_product_accepted'])->name('customer.transaction.product.accepted');
    Route::put('/customer/order-service-completed/{transaction_order_id}', [CustomerProfileController::class, 'order_service_accepted'])->name('customer.order.service.accepted');
});
