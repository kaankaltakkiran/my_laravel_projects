<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
     /*    die and dump */
        //dd('ok');
       // dd($request->all());
        //return view('auth.register');

        //validate
        $validated=$request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email','max:255'],
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
          User::create($validated);

          dd('ok');

        //Login

        //Redirect
    }
}
