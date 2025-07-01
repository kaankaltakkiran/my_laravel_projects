<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/get-cities/{country_id}', [HomeController::class, 'getCities']);
Route::get('/get-districts/{city_id}', [HomeController::class, 'getDistricts']);
