<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;



// Product Management Routes
Route::resource('products', ProductController::class);

// Additional route for toggling status
Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
    ->name('products.toggleStatus');

Route::resource('categories', CategoryController::class);

Route::resource('blogs', BlogController::class);
Route::patch('blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggleStatus');


Route::resource('sliders', SliderController::class);
Route::patch('sliders/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('sliders.toggleStatus');

// Root route
Route::get('/', fn() => view('welcome'));
