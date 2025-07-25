<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthorController extends Controller
{
    public function index()
    {

        //return Author::all();
        return Author::with('user')->latest()->get();
    }
    public function store(Request $request)
    {
        $author = $request->user()->authors()->create($request->all());
        return response()->json([
            'message' => 'Author başarıyla kaydedildi',
            'author' => $author,
            'user' => $author->user,
        ]);

        return $author;
    }
    public function show(Author $author)
    {
        return response()->json([
            'author' => $author,
            'user' => $author->user,
        ]);

    }
    public function update(Request $request, Author $author)
    {
        Gate::authorize('modify', $author);

        $author->update($request->all());
        return response()->json([
            'author' => $author,
            'message' => 'Author güncellendi',
        ]);

    }

    public function destroy(Author $author)
    {
        Gate::authorize('modify', $author);

        $author->delete();
        return response()->json([
            'message' => 'Blog silindi',
        ]);

    }
}
