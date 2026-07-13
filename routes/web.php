<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('home');

// Order
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/track/{id}', [OrderController::class, 'track'])->name('order.track');

// Admin Auth (halaman login khusus admin, boleh diakses tanpa login)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Admin Dashboard (tersembunyi di balik login, wajib login untuk akses)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings');
    Route::post('/products', [AdminController::class, 'updateProducts'])->name('admin.products');
    Route::post('/testimonials', [AdminController::class, 'updateTestimonials'])->name('admin.testimonials');
    Route::post('/order/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.status');
    Route::delete('/order/{id}', [AdminController::class, 'deleteOrder'])->name('admin.order.delete');
});
