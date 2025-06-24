<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * kullanıcının postlarını listeler
     */
    public function index()
    {
        // post sayfasını göster
        //dizi ile veri yolluyoruz
       /*  return view('posts.index',[
            'posts'=>Post::all(),
        ]); */
          
        //postları oluştur.
        //created_at göre sırala.
        //$posts=Post::orderBy('created_at','desc')->get();
        //yukardaki ile aynı
        //paginate ile sayfalama yapar.s
        $posts=Post::latest()->paginate(6);

        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * gönderi olusturma sayfasını açar
     */
    public function create()
    {
        //
    }

    /**
     * veri tabanına yeni bir post ekler
     */
    public function store(Request $request)
    {
        //validation
        $validated=$request->validate([
            'title'=>['required','max:255'],
            'body'=>'required',
        ]);
        //post oluştur
        //ilgi kullanıcıya ait post oluşturur. 
        Auth::user()->posts()->create($validated);
         
        // with metodu ile session mesajı oluşturur.
        //yani key value ile session mesajı oluşturur.
        return back()->with('success','Post created successfully');
    }

    /**
     * gönderi detaylarını gösterir
     */
    public function show(Post $post)
    {
        //show sayfasını göster ve postları yola
        return view('posts.show',[
            'post'=>$post,
        ]);
    }

    /**
     * gönderi düzenleme sayfasını açar
     */
    public function edit(Post $post)
    {
        //edit sayfasını göster ve postları yola
        return view('posts.edit',['post'=>$post]);   
    }

    /**
     * veri tabanındaki postu günceller
     */
    public function update(Request $request, Post $post)
    {
        //
         //validation
        $validated=$request->validate([
            'title'=>['required','max:255'],
            'body'=>'required',
        ]);
        //update post
       $post->update($validated);
         
        // with metodu ile session mesajı oluşturur.
        //yani key value ile session mesajı oluşturur.
        return redirect('dashboard')->with('success','Post updated successfully');
    }

    /**
     * veri tabanındaki postu siler
     */
    public function destroy(Post $post)
    {
        //postları sil
        $post->delete();
        //sildikten sonra yönlendirme
        return back()->with('delete','Post deleted successfully');
    }
}
