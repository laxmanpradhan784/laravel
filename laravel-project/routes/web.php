<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;

// Public Routes
Route::get('/', [SliderController::class, 'showSliders'])->name('sliders.show');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Authentication Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Order Routes
    Route::get('/order-summary', [OrderController::class, 'showSummary'])->name('order.summary');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/payment/{order}', [OrderController::class, 'showPaymentPage'])->name('payment.page');
    Route::post('/payment/process/{order}', [OrderController::class, 'processPayment'])->name('payment.process');
    Route::get('/order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');

    // Cart Routes
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Product and Blog Routes
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('blogs', [BlogController::class, 'showBlogs'])->name('blogs.index');
    Route::get('blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
