<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PrimaryCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminAuth;
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
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');
Route::get('/lab-test', [PharmacyController::class, 'lab_test'])->name('lab-test.index');
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/search-medicines', [ProductController::class, 'searchMedicines'])->name('search-medicines');
Route::get('/quick-order', [OrderController::class, 'quickOrder'])->name('quick-order');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about');

Route::resources([
    '/wishlist' => WishlistController::class,
]);

Route::middleware('auth')->group(function () {
    Route::get('/my-account', [AccountController::class, 'user_account'])->name('my-account');
});


Route::get('/admin/login', [AuthController::class, 'admin_login'])->name('admin.login');
Route::get('/admin/logout', [AuthController::class, 'admin_logout'])->name('admin.logout');

Route::prefix('/admin')->middleware('admin')->group(function () {
    // Dashboard route
    Route::get('/', [DashboardController::class, 'admin_dashboard'])->name('admin-dashboard');
      
    // Primary categories routes
    Route::resource('primary-categories', PrimaryCategoryController::class);
    Route::get('/primary-categories', [PrimaryCategoryController::class, 'admin_primary_categories_index'])->name('admin.primary-categories.index');
    Route::post('/primary-categories/get', [PrimaryCategoryController::class, 'get'])->name('primary-categories.get');

    // Categories routes
    Route::resource('categories', CategoryController::class);
    Route::get('/categories', [CategoryController::class, 'admin_categories_index'])->name('admin.categories.index');
    Route::post('/categories/get', [CategoryController::class, 'get'])->name('categories.get');
    Route::get('/categories-by-primary-category', [CategoryController::class, 'getByPrimaryCategory'])->name('categories.get-by-primary-category');

    // Sub Categories routes
    Route::resource('sub-categories', SubCategoryController::class);
    Route::get('/sub-categories', [SubCategoryController::class, 'admin_subcategories_index'])->name('admin.sub-categories.index');
    Route::post('/sub-categories/get', [SubCategoryController::class, 'get'])->name('sub-categories.get');
        
    // Brands routes
    Route::resource('brands', BrandController::class);
    Route::get('/brands', [BrandController::class, 'admin_brands_index'])->name('admin.brands.index');
    Route::post('/brands/get', [BrandController::class, 'get'])->name('brands.get');
        
    // Diseases routes
    Route::resource('diseases', DiseaseController::class);
    Route::get('/diseases', [DiseaseController::class, 'admin_diseases_index'])->name('admin.diseases.index');
    Route::post('/diseases/get', [DiseaseController::class, 'get'])->name('diseases.get');

    // Products routes
    Route::resource('products', ProductController::class);
    Route::get('/products', [ProductController::class, 'admin_index'])->name('admin.products.index');
    Route::post('/products/get', [ProductController::class, 'get'])->name('products.get');
});
