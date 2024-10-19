<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::middleware('auth:sanctum')->group(function () {
    // Categories API routes
    Route::apiResource('categories', CategoryController::class);

    // Products API routes
    Route::apiResource('products', ProductController::class);

    // Order API route
    Route::post('order', [OrderController::class, 'store']);
});

