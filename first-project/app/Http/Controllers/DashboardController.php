<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //kullanıcı postları
        //giriş yapan kullanıcının id'sini alıp onun postlarını getiriyoruz
       // $posts=Post::where('user_id',Auth::id())->get();
       //user modelinde postları user ile ilişkilendirmiştik.
       //sayfalama ve en sona göre sıralama
       $posts=Auth::user()->posts()->latest()->paginate(6);

       //verileri view'a gönderiyoruz
        return view('users.dashboard',['posts'=>$posts]);
    }
}
