<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodosRequest;
use App\Http\Requests\UpdateTodosRequest;
use App\Models\Todos;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Todos $todos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodosRequest $request, Todos $todos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todos $todos)
    {
        //
    }
}
