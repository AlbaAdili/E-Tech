<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\CustomAuthController;

use App\Http\Controllers\AboutController;

Route::resource('home', HomeController::class);
Route::resource('product', ProductController::class);
Route::resource('faqs', FaqsController::class);

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::post('product', [ProductController::class, 'store'])->name('product.store');
Route::put('product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('product.destory');
Route::post('product/search', [ProductController::class, 'search'])->name('product.search');
Route::get('faqs', [FaqsController::class, 'index'])->name('faqs.index');
Route::get('about', [AboutController::class, 'index'])->name('about');

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOutConfirmation'])->name('signout.confirmation');
Route::post('custom-signout', [CustomAuthController::class, 'customSignOut'])->name('signout.custom');

