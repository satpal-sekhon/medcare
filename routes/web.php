<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrimaryCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
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
    Route::get('/my-account', [AccountController::class, 'user_account'])->name('my-account');
});


Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'admin_dashboard'])->name('admin-dashboard');
      
    // Primary categories routes
    Route::get('/primary-categories', [PrimaryCategoryController::class, 'admin_primary_categories_index'])->name('admin.primary-categories.index');
    Route::get('/primary-categories/create', [PrimaryCategoryController::class, 'create'])->name('admin.primary-categories.create');
    Route::post('/primary-categories/create', [PrimaryCategoryController::class, 'store'])->name('primary-categories.store');
    Route::post('/primary-categories/get', [PrimaryCategoryController::class, 'get'])->name('primary-categories.get');
        
    // Categories routes
    Route::get('/categories', [CategoryController::class, 'admin_categories_index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        
    // Sub-categories routes
    Route::get('/sub-categories', [ProductController::class, 'admin_sub_categories_index'])->name('admin.sub-categories.index');
    Route::get('/sub-categories/create', [ProductController::class, 'create'])->name('admin.sub-categories.create');
        
    // Brands routes
    Route::get('/brands', [BrandController::class, 'admin_brands_index'])->name('admin.brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
      
    // Product management routes
    Route::get('/products', [ProductController::class, 'admin_index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
});
