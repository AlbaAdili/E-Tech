<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::resource('home', HomeController::class);
Route::resource('product', ProductController::class);

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::post('product', [ProductController::class, 'store'])->name('product.store');


