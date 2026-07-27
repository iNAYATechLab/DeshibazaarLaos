<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ExchangeCalculatorController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/money-exchange', ExchangeCalculatorController::class)->name('exchange.calculator');

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
    });
});
