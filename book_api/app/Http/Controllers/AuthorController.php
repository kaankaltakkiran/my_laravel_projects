<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {

        return Author::all();
    }
    public function store(Request $request)
    {
        $author = Author::create($request->all());
        return $author;
    }
    public function show(Author $author)
    {
        return $author;
    }
    public function update(Request $request, Author $author)
    {
        $author->update($request->all());
        return $author;
    }

    public function destroy(Author $author)
    {

        $author->delete();
        return ["message" => "Author deleted successfully"];
    }
}
