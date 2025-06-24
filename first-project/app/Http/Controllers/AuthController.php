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
        //login kontrol etmez bilgileri.
        Auth::login($user);

        //Redirect

        //login başarılı ise home page git. 
       // return redirect()->route('home');
       return redirect()->route('dashboard');
    }
    public function login(Request $request)
    {
      //validate user 
        $validated=$request->validate([
            'email' => ['required','email','max:255'],
            'password' => ['required'],
        ]);
          //login user
          //attempt kullanıcı doğrulamasını sağlar
          //attempt başarılı ise 1 başarısız ise 0 döndürür
          //remember remember checkbox unu aktif eder
          if(Auth::attempt($validated,$request->remember)){

            //login başarılı ise home page git. 
            //return redirect()->route('home');

            //intended girş yapması gereken bir sayfaya login olduktan sonra gitmesini sağlar
            //return redirect()->intended();
            return redirect()->intended('dashboard');
          }
          //login başarısız ise login sayfasına geri git.
          return back()->withErrors([
            'failed' => 'Plase check your credentials and try again',
          ]);

    }

    //Logout user
    public function logout(Request $request)
    {
      //logout kullanıcı oturumunu sonlandır
      Auth::logout();
      //oturumu geçersiz kılmak için
     $request->session()->invalidate();
     //oturum yeniden oluşturulur(csrf token)
     $request->session()->regenerateToken();
      //redirect home page
     // return redirect()->route('home');
     return redirect()->route('dashboard');
    }
}
