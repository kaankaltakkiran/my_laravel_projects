<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('user')->latest()->get();

    }
    public function store(Request $request)
    {
        $book = $request->user()->books()->create($request->all());
        return response()->json([
            'message' => 'Book başarıyla kaydedildi',
            'book' => $book,
            'user' => $book->user,
        ]);

    }
    public function show(Book $book)
    {
        return response()->json([
            'book' => $book,
            'user' => $book->user,
        ]);
    }
    public function update(Request $request, Book $book)
    {
        Gate::authorize('modify', $book);

        $book->update($request->all());
        return response()->json([
            'book' => $book,
            'message' => 'Book güncellendi',
        ]);

    }

    public function destroy(Book $book)
    {
        Gate::authorize('modify', $book);

        $book->delete();
        return response()->json([
            'message' => 'Book Silindi',
        ]);
    }
}
