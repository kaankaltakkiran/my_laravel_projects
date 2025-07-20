<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {

        return Blog::all();
    }
    public function store(Request $request)
    {
        $blog = Blog::create($request->all());
        return $blog;
    }
    public function show(Blog $blog)
    {
        return $blog;
    }
    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->all());
        return $blog;
    }

    public function destroy(Blog $blog)
    {

        $blog->delete();
        return ["message" => "Blog silindi"];
    }
}
