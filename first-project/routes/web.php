<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;

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

});
//auth middleware ile sadece auth user için route erişimini sağlar
Route::middleware('auth')->group(function () {
 //dashboard için route
//middleware ile sadece auth user için route erişimini sağlar
//->middleware('auth')
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});





