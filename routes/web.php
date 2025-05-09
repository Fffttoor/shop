<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckForAdminAccess;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class)->only(['show']);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');

    Route::resource('orders', OrderController::class)->except(['destroy']);
});
Route::prefix('/admin')->middleware(['auth', 'verified', CheckForAdminAccess::class])->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
});
