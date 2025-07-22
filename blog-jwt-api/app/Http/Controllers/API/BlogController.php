<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {

        return Blog::with('user')->latest()->get();
    }
    public function store(Request $request)
    {

        $blog = $request->user()->blogs()->create($request->all());
        return response()->json([
            'message' => 'Blog başarıyla kaydedildi',
            'blog' => $blog,
            'user' => $blog->user,
        ]);
    }
    public function show(Blog $blog)
    {
        return response()->json([
            'blog' => $blog,
            'user' => $blog->user,
        ]);
    }
    public function update(Request $request, Blog $blog)
    {
        Gate::authorize('modify', $blog);

        $blog->update($request->all());
        return response()->json([
            'blog' => $blog,
            'message' => 'Blog güncellendi',
        ]);
    }

    public function destroy(Blog $blog)
    {
        Gate::authorize('modify', $blog);

        $blog->delete();
        return response()->json([
            'message' => 'Blog silindi',
        ]);
    }
}
