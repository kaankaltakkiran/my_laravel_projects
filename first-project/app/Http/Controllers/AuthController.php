<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
     /*    die and dump */
        //dd('ok');
       // dd($request->all());
        //return view('auth.register');

        //validate
        // unique:users users tablosundaki email uniquesi
        $validated=$request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email','max:255','unique:users'],
            'password' => ['required','min:3','confirmed'],
        ]);

        //Register

      /*   buradaki User oluşturduğumuz model */
        /*   User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
          ]); */
         //validated olmuş verileri kullanarak database e kaydet
         //password hashed edilir(laravel tarafından)
         $user = User::create($validated);

        //Login

        //register edilen kullanıcının otomatik login olmasını sağlıyor
        Auth::login($user);

        //Redirect

        //login başarılı ise home page git. 
        return redirect()->route('home');
    }
}
