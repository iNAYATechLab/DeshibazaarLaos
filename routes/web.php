<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ExchangeCalculatorController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/money-exchange', ExchangeCalculatorController::class)->middleware('throttle:30,1')->name('exchange.calculator');
Route::get('/shop', StoreController::class)->name('store.index');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/shop/category/{category:slug}', [StoreController::class, 'category'])->name('store.category');
Route::get('/shop/product/{product}', [StoreController::class, 'product'])->name('store.product');
Route::post('/language/{locale}', LocaleController::class)->name('locale.set');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/contact', ContactController::class)->name('contact');
Route::post('/cart/{product}', [CartController::class, 'add'])->middleware('throttle:20,1')->name('cart.add');
Route::put('/cart', [CartController::class, 'update'])->middleware('throttle:20,1')->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::prefix('admin')->name('admin.')->middleware('super-admin')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::get('/exchange-rates', [\App\Http\Controllers\Admin\ExchangeRateController::class, 'index'])->name('exchange-rates.index');
        Route::put('/exchange-rates', [\App\Http\Controllers\Admin\ExchangeRateController::class, 'update'])->name('exchange-rates.update');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->only(['index','store','update','destroy']);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->only(['index','store','update','destroy']);
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    });
});
