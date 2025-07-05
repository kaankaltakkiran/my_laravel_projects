<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

/* /api/posts url karşılığı */
/* Route::get('/posts',function(){
return 'API';
}); */

/* apiResource crud operasyonları gerçekleştirir.
php artisan route:list ile kontrol et
örnek api/posts
*/
Route::apiResource('posts',PostController::class);

//kullanıcı auth işlemleri
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
//logout için auth middleware eklendi burda token kontrolü yapar
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');




