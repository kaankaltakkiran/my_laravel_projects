<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'username' => ['required','max:255'],
            'email' => ['required','email','max:255'],
            'password' => ['required','min:3','confirmed'],
        ]);

        dd('ok');

        //Register


        //Login

        //Redirect
    }
}
