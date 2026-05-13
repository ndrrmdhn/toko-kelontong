<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;

// Frontend Routes
Route::get('/', [HomeController::class, 'landing'])->name('landing');
Route::get('/produk', [HomeController::class, 'products'])->name('products.index');
Route::get('/produk/{product}', [HomeController::class, 'show'])->name('products.show');
Route::get('/kontrakan', [HomeController::class, 'rentals'])->name('rentals.index');

// Auth Routes
Auth::routes();

// Admin Routes (Protected)
Route::middleware(['auth', 'role:super_admin,admin_toko,admin_kontrakan,kasir'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Super Admin & Admin Toko Only
    Route::middleware('role:super_admin,admin_toko')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('banners', BannerController::class);
        Route::resource('services', ServiceController::class);
    });

    // Super Admin & Admin Kontrakan Only
    Route::middleware('role:super_admin,admin_kontrakan')->group(function () {
        Route::resource('rentals', RentalController::class);
    });

    // Super Admin Only
    Route::middleware('role:super_admin')->group(function () {
        Route::resource('settings', SettingController::class)->only(['index', 'update']);
    });
});

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
