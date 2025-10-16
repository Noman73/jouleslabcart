<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminAuthenticationController;

Route::get('/', [\App\Http\Controllers\HomePageController::class, 'index'])->name('home');
Route::prefix('api')->group( function () {
    Route::post('/add/cart', [CartController::class, 'addToCart'])->name('api.add.cart');
    Route::post('/remove/cart', [CartController::class, 'removeFromCart'])->name('api.remove.cart');
    Route::get('/cart', [CartController::class, 'getCart'])->name('api.cart');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('api.update.cart');
    Route::post('/cart/apply_coupons', [CartController::class, 'applyCoupon'])->name('api.cart.apply_coupons');
});

Route::prefix('admin')->group( function () {
    Route::get('/login', [AdminAuthenticationController::class, 'loginPage']);
    Route::post('/login', [AdminAuthenticationController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AdminAuthenticationController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
//Route::get("/admin/product",[\App\Http\Controllers\ProductController::class, 'index']);
    Route::resource('/product', ProductController::class);
//    Route::resource('/cart', CartController::class);
    Route::resource('/coupons', CouponController::class);
});

