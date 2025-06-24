<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    //kullanıcı gönderiyi değiştirme yetkisi
    public function modify(User $user, Post $post):bool
    {
        //giriş yapan kullanıcı ile gönderinin sahibi aynıysa true döndürür.
        return $user->id === $post->user_id;
    }
}
