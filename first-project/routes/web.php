<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('posts.index');
})->name('home');

/* / ile url yönlendirme yapar
return ile hangi sayfa render edilecegini belirler
name ile route olunacak isim verilir */

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

/* form post için route ekleme AuthController sorumlu */
/* Route::post('/register', [AuthController::class, 'register'])->name('register.post'); */

/* name vermene gerek yok son register contorledeki function ismi  */
Route::post('register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

