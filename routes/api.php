<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DiseaseController;
use App\Http\Controllers\Api\PharmacyController;
use App\Http\Controllers\Api\PrimaryCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('primary-categories')->group(function () {
    Route::get('/', [PrimaryCategoryController::class, 'index']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'index']);
});

Route::prefix('diseases')->group(function () {
    Route::get('/', [DiseaseController::class, 'index']);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
});

Route::prefix('pharmacies')->group(function () {
    Route::get('/', [PharmacyController::class, 'index']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
