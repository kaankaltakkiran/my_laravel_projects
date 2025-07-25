<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {

        return Category::with('user')->latest()->get();
    }
    public function store(Request $request)
    {
        $category = $request->user()->categories()->create($request->all());
        return response()->json([
            'message' => 'Category başarıyla kaydedildi',
            'category' => $category,
            'user' => $category->user,
        ]);

    }
    public function show(Category $category)
    {
        return response()->json([
            'category' => $category,
            'user' => $category->user,
        ]);
    }
    public function update(Request $request, Category $category)
    {
        Gate::authorize('modify', $category);

        $category->update($request->all());
        return response()->json([
            'category' => $category,
            'message' => 'Category güncellendi',
        ]);

    }

    public function destroy(Category $category)
    {
        Gate::authorize('modify', $category);

        $category->delete();
        return response()->json([
            'message' => 'Category silindi',
        ]);

    }
}
