<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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



