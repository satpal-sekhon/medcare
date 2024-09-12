<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/signup', [AuthController::class, 'signup'])->name('sign-up');
Route::post('/create-account', [AuthController::class, 'create_account'])->name('create-account');

Route::get('/vendor-registration', [AuthController::class, 'vendor_registration'])->name('vendor-registration');
Route::get('/create-vendor-account', [AuthController::class, 'create_vendor_account'])->name('create-vendor-account');

Route::get('/verify-email', [AuthController::class, 'verify_email'])->name('verify-email');
Route::get('/resend-verification-email', [AuthController::class, 'resend_verification_email'])->name('resend-verification-email');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');

Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('forgot-password');
Route::post('send-reset-password-mail', [AuthController::class, 'send_reset_password_email'])->name('reset-password-mail');

Route::get('/reset-password', [AuthController::class, 'changePassword'])->name('change-password');
Route::post('/password', [AuthController::class, 'password'])->name('password');

Route::get('/admin/login', [AuthController::class, 'admin_login'])->name('admin.login');
Route::get('/admin/logout', [AuthController::class, 'admin_logout'])->name('admin.logout');

Route::get('/password/reset/{token}', [AuthController::class, 'reset_password'])->name('password.reset');
