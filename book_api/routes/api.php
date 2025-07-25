<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('authors', AuthorController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('books', BookController::class);
