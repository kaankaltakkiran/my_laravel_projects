<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductPdfController;

Route::get('/', function () {
    return view('pdf-menu');
});

// PDF oluşturma route'u
Route::get('/generate-product-pdf', [ProductPdfController::class, 'generateProductPdf'])->name('generate.product.pdf');
