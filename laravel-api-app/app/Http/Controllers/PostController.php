<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        /* auth:sanctum middleware'si ile sadece authenticated kullanıcılar post oluşturabilir.
       except ile index ve show methodları dışındaki tüm methodlara auth:sanctum middleware'si uygulanır.
       */
       return [ new Middleware('auth:sanctum',except:['index','show'])];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tüm postları getirir.
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Postları veritabanına kaydeder.

        //postları validasyon yapar.
        $fields=$request->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
        ]);
       //validate edilen verileri post tablosuna kaydeder
       //kullanıcıya ait postları oluşturur.
        $post=$request->user()->posts()->create($fields);
        //kaydedilen verileri geri döndürür.
        return $post;
        //buda olur.
        //return ['post'=>$post];
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //Belirli bir postu getirir.
         return $post;
        //buda olur.
        //return ['post'=>$post];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //verileri güncelleme

        //postun sahibi mi kontrol et
         Gate::authorize('modify', $post);

        //postları validasyon yapar.
        $fields=$request->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
        ]);
       //güncellenen verileri post tablosuna kaydeder.
        $post->update($fields);        
        //kaydedilen verileri geri döndürür.
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //postun sahibi mi kontrol et
        Gate::authorize('modify',$post);

        //verileri silme
        $post->delete();
        //mesaj dönme          
        return ['message'=>'Post deleted successfully.'];
    }
}
