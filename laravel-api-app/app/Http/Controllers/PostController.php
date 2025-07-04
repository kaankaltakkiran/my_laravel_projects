<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
       //validate edilen verileri post tablosuna kaydeder.
        $post=Post::create($fields);
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
        //verileri silme
        $post->delete();
        //mesaj dönme          
        return ['message'=>'Post deleted successfully.'];
    }
}
