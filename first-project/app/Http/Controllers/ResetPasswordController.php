<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;


class ResetPasswordController extends Controller
{
    // password sıfırlamak için sorduğu emaili post ile gönderir.
    public function passwordEmail (Request $request) {
    $request->validate(['email' => ['required', 'email']]);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
}
//passowrd reset token sayfasına yönlendirme
public function passwordReset(string $token){
    return view('auth.reset-password', ['token' => $token]);
}
//password update eden kısım
public function passwordUpdate (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => ['required', 'email'],
        'password' => ['required', 'confirmed'],
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}
}
