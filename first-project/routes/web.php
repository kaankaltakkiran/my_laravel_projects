<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

