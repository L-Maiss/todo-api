<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(Auth::user()->todos);
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = Auth::user()->todos()->create($request->validated());

        return response()->json($todo, 201);
    }

    public function update(UpdateTodoRequest $request, $id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);

        $todo->update($request->validated());

        return response()->json($todo, 200);
    }

    public function destroy($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->delete();

        return response()->json(['message' => 'Todo deleted'], 200);
    }
}
