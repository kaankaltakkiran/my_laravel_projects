<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// JWT gerektirmeyen Crud işlemleri
Route::get('authors', [AuthorController::class, 'index']);
Route::get('authors/{author}', [AuthorController::class, 'show']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);

// JWT gerektirmeyen Auth işlemleri
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// JWT gerektiren işlemler
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    // JWT gerektiren Crud işlemleri
    Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);
    Route::apiResource('categories', CategoryController::class, )->except(['index', 'show']);
    Route::apiResource('books', BookController::class);
});
