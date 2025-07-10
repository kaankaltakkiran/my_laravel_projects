<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [new Middleware('auth:sanctum', except: ['index', 'show'])];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Todo::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => 'required',
            'completed' => 'required|boolean',
        ]);
        $todo = $request->user()->todos()->create($fields);
        return [
            'todo' => $todo,
            'user' => $todo->user,
        ];

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
        return [
            'todo' => $todo,
            'user' => $todo->user,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
        Gate::authorize('modify', $todo);

        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => 'required',
            'completed' => 'required|boolean',
        ]);

        $todo->update($fields);
        return $todo;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {

        Gate::authorize('modify', $todo);

        $todo->delete();

        return ['message' => 'Todo deleted successfully.'];

    }
}
