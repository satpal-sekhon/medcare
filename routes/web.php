<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/signup', [AuthController::class, 'signup'])->name('sign-up');
Route::get('/verify-email', [AuthController::class, 'verify_email'])->name('verify-email');
Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('forgot-password');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::resources([
    '/products' => ProductController::class,
    '/wishlist' => WishlistController::class,
]);

Route::middleware('auth')->group(function () {
    //Route::get('/my-account', [AccountController::class, 'user_account']);
});

Route::get('/my-account', [AccountController::class, 'user_account']);