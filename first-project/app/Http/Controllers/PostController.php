<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\WelcomeMail;

/* HasMiddleware ile ara katman ekledik */
class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
       
        return [
             /* auth middleware sadece store methoduna uygulanacak */
          // new Middleware('auth',only:['store']),
          /*  index ve show methodlarına uygulanacak
          login sayfasına yönlendircek
          */
           new Middleware('auth',except:['index','show']),
        ];
    }
    /**
     * kullanıcının postlarını listeler
     */
    public function index()
    {
        //welcome mail gönder
       /*  Mail::to('kaan@gmail.com')->send(new WelcomeMail(Auth::user())); */






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
        $request->validate([
            'title'=>['required','max:255'],
            'body'=>'required',
            'image'=>['nullable','file','max:2048','mimes:jpeg,png,jpg,webp']
        ]);

           //upload image
        //1. dosya ismini al
        //2. kısım dosyayı al
        // Storage::put('posts_images',$request->image);
        
         //dosya olup olmadığına bakar
         $path=null;
         if($request->hasFile('image')){
             //üsteki locale kaydeder. bu argüman ise public olarak  kaydeder.
        $path= Storage::disk('public')->put('posts_images',$request->image); 
      
         } 
         
        //post oluştur
        //ilgi kullanıcıya ait post oluşturur. 
        $post=Auth::user()->posts()->create([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path
        ]);

        //send email
        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));
         
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
        //Gate ile yetkisiz kullanıcıları engeller.
        Gate::authorize('modify',$post);
        //edit sayfasını göster ve postları yola
        return view('posts.edit',['post'=>$post]);   
    }

    /**
     * veri tabanındaki postu günceller
     */
    public function update(Request $request, Post $post)
    {
        //Gate ile yetkisiz kullanıcıları engeller.
        Gate::authorize('modify',$post);
         //validation
          $request->validate([
            'title'=>['required','max:255'],
            'body'=>'required',
            'image'=>['nullable','file','max:2048','mimes:jpeg,png,jpg,webp']
        ]);
        //update image

            //dosya olup olmadığına bakar
         $path=$post->image??null;
         if($request->hasFile('image')){
            //eski dosyayı siler
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
             //üsteki locale kaydeder. bu argüman ise public olarak  kaydeder.
        $path= Storage::disk('public')->put('posts_images',$request->image); 
         } 
        //update post
       $post->update([
           'title'=>$request->title,
           'body'=>$request->body,
           'image'=>$path
       ]);
         
        // with metodu ile session mesajı oluşturur.
        //yani key value ile session mesajı oluşturur.
        return redirect('dashboard')->with('success','Post updated successfully');
    }

    /**
     * veri tabanındaki postu siler
     */
    public function destroy(Post $post)
    {
         //Gate ile yetkisiz kullanıcıları engeller.
        Gate::authorize('modify',$post);
        //delete post image
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        //postları sil
        $post->delete();
        //sildikten sonra yönlendirme
        return back()->with('delete','Post deleted successfully');
    }
}
