<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DoctorConsultationOrderController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorTypeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LabPackageController;
use App\Http\Controllers\LabPackageOrderController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PrimaryCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuickOrderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Include the auth routes
require __DIR__.'/auth.php';

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/orders/create', [OrderController::class, 'create_order'])->name('order.create');
Route::get('/order-success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.view');
Route::get('/disease/{disease:slug}', [DiseaseController::class, 'show'])->name('disease.view');
Route::get('/primary-category/{primary_category:slug}', [PrimaryCategoryController::class, 'show'])->name('primary-category.view');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.view');
Route::get('/brand/{brand:slug}', [BrandController::class, 'show'])->name('brand.view');

Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');

Route::get('/lab-test', [LabPackageController::class, 'index'])->name('lab-test.index');
Route::get('/lab-package/{labPackage}', [LabPackageController::class, 'show'])->name('lab-package.show');
Route::get('/book-package/{labPackage}', [LabPackageController::class, 'book'])->name('lab-package.book');
Route::post('/order-lab-package', [LabPackageOrderController::class, 'store'])->name('lab-package.order');

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{doctor}', [DoctorController::class, 'consult'])->name('doctors.consult');
Route::post('/consult-doctor', [DoctorConsultationOrderController::class, 'store'])->name('doctors.bookConsultation');

Route::get('/search-medicines', [ProductController::class, 'searchMedicines'])->name('search-medicines');
Route::get('/search-medicines/{alphabet}', [ProductController::class, 'searchMedicines'])->name('search-medicine.alphabet');

Route::get('/quick-order', [QuickOrderController::class, 'create'])->name('quick-order');
Route::post('/quick-order', [QuickOrderController::class, 'store'])->name('quick-order.store');

Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about-us');

Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('coupon.apply');
Route::post('/send-notification', [UserController::class, 'sendNotification'])->name('notification.send');

Route::resources([
    '/wishlist' => WishlistController::class,
]);

Route::prefix('cart')->group(function () {
    Route::post('/', [CartController::class, 'addOrUpdate'])->name('cart.add-or-update');
    Route::delete('/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/details', [CartController::class, 'getDetails'])->name('cart.details');
});


Route::middleware('auth')->group(function () {
    Route::prefix('/my-account')->group(function () {
        Route::resources([
            '/addresses' => AddressController::class,
        ]);

        Route::get('/', [AccountController::class, 'user_account'])->name('my-account');
        Route::get('/wishlist', [AccountController::class, 'wishlist'])->name('my-account.wishlist');
        Route::get('/orders', [AccountController::class, 'orders'])->name('my-account.orders');
        Route::get('/notifications', [AccountController::class, 'notifications'])->name('my-account.notifications');
        Route::get('/profile', [AccountController::class, 'profile'])->name('my-account.profile');
    });
});


Route::prefix('/vendor')->middleware('vendor')->group(function () {
    // Submit docs for verification
    Route::post('/submit-docs-for-verification', [AccountController::class, 'submit_vendor_docs_for_verification'])->name('vendor.submit-docs-for-verification');

    // Dashboard route
    Route::get('/', [DashboardController::class, 'vendor_dashboard'])->name('vendor-dashboard');
});


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

    // Coupons routes
    Route::resource('coupons', CouponController::class);
    Route::get('/coupons', [CouponController::class, 'admin_index'])->name('admin.coupons.index');
    Route::post('/coupons/get', [CouponController::class, 'get'])->name('coupons.get');

    // Users routes
    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'admin_index'])->name('admin.users.index');
    Route::get('/user-orders/{user}', [UserController::class, 'user_orders'])->name('admin.user.orders');
    Route::get('/suspended-users', [UserController::class, 'suspended_users'])->name('admin.users.suspended');
    Route::post('/users/get', [UserController::class, 'get'])->name('users.get');

    // Vendor routes
    Route::resource('vendors', VendorController::class);
    Route::get('/all-vendors', [VendorController::class, 'all_vendors_index'])->name('admin.vendors.all');
    Route::get('/new-vendors', [VendorController::class, 'new_vendors_index'])->name('admin.vendors.new');
    Route::get('/vendors', [VendorController::class, 'admin_index'])->name('admin.vendors.index');
    Route::get('/inactive-vendors', [VendorController::class, 'inactive_admin_index'])->name('admin.vendors.inactive');
    Route::get('/pending-approval-vendors', [VendorController::class, 'pending_approval_index'])->name('admin.vendors.pending-approvals');
    Route::get('/suspended-vendors', [VendorController::class, 'suspended_admin_index'])->name('admin.vendors.suspended');

    // Doctor types routes
    Route::resource('doctor-types', DoctorTypeController::class);
    Route::get('/doctor-types', [DoctorTypeController::class, 'admin_index'])->name('admin.doctor-types.index');
    Route::post('/doctor-types/get', [DoctorTypeController::class, 'get'])->name('doctor-types.get');

    // Doctors routes
    Route::resource('doctors', DoctorController::class);
    Route::get('/doctors', [DoctorController::class, 'admin_index'])->name('admin.doctors.index');
    Route::post('/doctors/get', [DoctorController::class, 'get'])->name('doctors.get');

    // Pharmacy store routes
    Route::resource('pharmacy-stores', PharmacyController::class);
    Route::get('/pharmacy-stores', [PharmacyController::class, 'admin_index'])->name('admin.pharmacy-stores.index');
    Route::post('/pharmacy-stores/get', [PharmacyController::class, 'get'])->name('pharmacy-stores.get');

    // Lab tests routes
    Route::resource('lab-tests', LabTestController::class);
    Route::get('/lab-tests', [LabTestController::class, 'admin_index'])->name('admin.lab-tests.index');
    Route::post('/lab-tests/get', [LabTestController::class, 'get'])->name('lab-tests.get');
    Route::resource('lab-tests', LabTestController::class);
    Route::get('/lab-tests', [LabTestController::class, 'admin_index'])->name('admin.lab-tests.index');
    Route::post('/lab-tests/get', [LabTestController::class, 'get'])->name('lab-tests.get');

    // Lab packages routes
    Route::resource('lab-packages', LabPackageController::class);
    Route::get('/lab-packages', [LabPackageController::class, 'admin_index'])->name('admin.lab-packages.index');
    Route::post('/lab-packages/get', [LabPackageController::class, 'get'])->name('lab-packages.get');

    // Orders routes
    Route::resource('orders', OrderController::class);
    Route::get('/orders', [OrderController::class, 'admin_index'])->name('admin.orders.index');
    Route::post('/orders/get', [OrderController::class, 'get'])->name('orders.get');

    // Quick order routes
    Route::resource('quick-orders', QuickOrderController::class);
    Route::get('/quick-orders', [QuickOrderController::class, 'admin_index'])->name('admin.quick-orders.index');
    Route::post('/quick-orders/get', [QuickOrderController::class, 'get'])->name('quick-orders.get');

    /* Lab package order routes */
    Route::resource('lab-package-orders', LabPackageOrderController::class);
    Route::get('/lab-package-orders', [LabPackageOrderController::class, 'admin_index'])->name('admin.lab-package-orders.index');
    Route::post('/lab-package-orders/get', [LabPackageOrderController::class, 'get'])->name('lab-package-orders.get');
    
    /* Doctor consultations routes */
    Route::resource('doctor-consultations', DoctorConsultationOrderController::class);
    Route::get('/doctor-consultations', [DoctorConsultationOrderController::class, 'admin_index'])->name('admin.doctor-consultations.index');
    Route::post('/doctor-consultations/get', [DoctorConsultationOrderController::class, 'get'])->name('doctor-consultations.get');

    /* Media routes */
    Route::get('/media', [MediaController::class, 'index'])->name('admin.media.index');
    Route::get('/get-media', [MediaController::class, 'get'])->name('admin.media.get');
    Route::delete('/media/delete', [MediaController::class, 'deleteImages'])->name('admin.media.delete');

    /* Setting routes */
    Route::get('/general-settings', [SettingController::class, 'admin_general_settings'])->name('admin.settings.general');
    Route::post('/general-settings', [SettingController::class, 'admin_general_settings_update'])->name('admin.settings.general.update');
    Route::get('/menu-settings', [SettingController::class, 'menuSettings'])->name('admin.settings.menu');
    Route::post('/menu-settings/{id}', [SettingController::class, 'updateMenuSettings'])->name('admin.settings.menu.update');

});


Route::get('/test-email', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('satpalsekhon01@gmail.com')->subject('Test Email');
    });

    return 'Email successfully sent!';
});
