<?php

use App\Http\Controllers\API\BlogController;
use Illuminate\Support\Facades\Route;

Route::apiResource('blogs', BlogController::class);
