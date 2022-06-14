<?php

use Illuminate\Support\Facades\Route;

// API Controllers
use App\Http\Controllers\API\AuthController;

// Products
use App\Http\Controllers\API\Products\ProductCategoriesController;
use App\Http\Controllers\API\Products\ProductsController;
use App\Http\Controllers\API\Products\ProductMonitoringController;

// Orders
use App\Http\Controllers\API\Orders\OrdersController;
use App\Http\Controllers\API\Orders\OrderPaymentsController;


// API Routes
Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    });

    Route::get('/product-monitoring', [ProductMonitoringController::class, 'index'])->name('product-monitoring.index');

    Route::apiResources([
        'product-categories' => ProductCategoriesController::class,
        'products' => ProductsController::class,
    ]);

    Route::apiResource('orders', OrdersController::class)->except(['destroy']);
    Route::apiResource('order-payments', OrderPaymentsController::class)->only(['index', 'store']);
});
