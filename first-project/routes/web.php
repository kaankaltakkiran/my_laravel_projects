<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/', function () {
    return view('posts.index');
})->name('home');
 */
//otomatik olarak posts route'ına yönlendirir.
Route::redirect('/', 'posts');

//postları user parametresine göre getirir.
Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');

// CRUD işlemleri için route
//hepsini tek tek yazmaktansa resource ile tek seferde yazabiliriz
Route::resource('posts', PostController::class);

//guest middleware ile sadece guest user için route erişimini sağlar
Route::middleware('guest')->group(function () {
    /* / ile url yönlendirme yapar
return ile hangi sayfa render edilecegini belirler
name ile route olunacak isim verilir */

//middleware ile sadece guest user için route erişimini sağlar
// >middleware('guest')
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

Route::post('/login', [AuthController::class, 'login']);

//Reset password sıfırlamak için sorduğumuz sayfaya yönlendirir.
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

//reset password için sorduğu emaili post ile gönderir.
Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail']);

//reset password token
Route::get('/reset-password/{token}', [ResetPasswordController::class,'passwordReset'])->name('password.reset');

//password update eden kısım
Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');

});
//auth middleware ile sadece auth user için route erişimini sağlar
Route::middleware('auth')->group(function () {
 //dashboard için route
//middleware ile sadece auth user için route erişimini sağlar
//->middleware('auth')
//verified middleware ile sadece verified user için route erişimini sağlar
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//email verification gözüken sayfa
Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
//email doğrulama sayfası
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
//yeniden email doğrulama isteği
//throttle ile 6 saniyede 1 kere istek kabul edilir
Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware('throttle:6,1')->name('verification.send');
});





