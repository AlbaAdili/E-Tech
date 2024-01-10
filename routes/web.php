<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::resource('home', \App\Http\Controllers\HomeController::class);
Route::resource('product', \App\Http\Controllers\ProductController::class);

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('product', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::post('product', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');


