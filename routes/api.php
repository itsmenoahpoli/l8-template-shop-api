<?php

use Illuminate\Support\Facades\Route;

// API Controllers
use App\Http\Controllers\API\AuthController;

// Products
use App\Http\Controllers\API\Products\ProductCategoriesController;
use App\Http\Controllers\API\Products\ProductsController;
use App\Http\Controllers\API\Products\ProductMonitoringController;


// API Routes
Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function() {

    });

    Route::get('/product-monitoring', [ProductMonitoringController::class, 'index'])->name('api.product-monitoring');

    Route::apiResources([
        'product-categories' => ProductCategoriesController::class,
        'products' => ProductsController::class,
    ]);
});
