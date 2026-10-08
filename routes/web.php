<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

// A "show" (egyedi megtekintés) oldalakat nem használjuk, ezért kihagyjuk.
Route::resource('categories', CategoryController::class)->except('show');
Route::resource('products', ProductController::class)->except('show');
