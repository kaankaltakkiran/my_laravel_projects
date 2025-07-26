<?php

// routes/api.php
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Kategori ve Ürünler için API kaynak rotaları
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
