<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    //kullanıcı postların hepsini görmek için
    public function userPosts(User $user)
    {
        //kullanıcı postları
     $userPosts=$user->posts()->latest()->paginate(6);
      //user modelinde postları user ile ilişkilendirmiştik.
     return view('users.posts',['posts'=>$userPosts,'user'=>$user]);   
    }
}
