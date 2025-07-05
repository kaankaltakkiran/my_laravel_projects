<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register( Request $request){
        //gelen isteği validate et
        $fields=$request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);
        //veritabanına kaydet
        $user=User::create($fields);
         //token oluştur kullanıcı adında
        $token=$user->createToken($request->name);
        //user ve tokeni döndür
        return[
         'user'=>$user,
         'token'=>$token->plainTextToken
        ];
    }
    public function login( Request $request){
       //gelen isteği validate et
       //exists:users users tablosundaki email var mı diye kontrol eder
         $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required'
        ]);
         //gelen istekteki email veritabınında var mı diye kontrol
         $user=User::where('email',$request->email)->first();
         //gelen isteki password ile veritbanında eşleşiyor mu ?

         //kullanıcı yoksa veya şifre eşleşmiyorsa
          if(!$user || !Hash::check($request->password,$user->password)){
            return response([
                'message'=>'The provided credentials do not match our records'
            ]);
          }
        //giriş başarılı token oluştur
        $token=$user->createToken($user->name);
        //user ve tokeni döndür
        return[
         'user'=>$user,
         'token'=>$token->plainTextToken
        ];

    }
    public function logout(Request $request){
        //ilgili kullanıcya ait tokenleri silme
        $request->user()->tokens()->delete();
        return[
          'message'=>'Logged out successfully'
        ];
    }
}
