<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * kullanıcının postlarını listeler
     */
    public function index()
    {
        // post sayfasını göster
        return view('posts.index');
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
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * gönderi detaylarını gösterir
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * gönderi düzenleme sayfasını açar
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * veri tabanındaki postu günceller
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * veri tabanındaki postu siler
     */
    public function destroy(Post $post)
    {
        //
    }
}
