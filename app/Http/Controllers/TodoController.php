<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function getAll(Request $request)
    {
        $todos = Todo::get();

        foreach ($todos as $todo) {

            $todo->incrementViewCount();
            $todo->save();
        }

        return response()->json($todos);
    }

    public function getOne(Request $request, $projectId)
    {
        $todo = Todo::findOrFail($projectId);

        $todo->incrementViewCount();
        $todo->save();

        return response()->json($todo);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'description' => ['required'],
            'project_id'  => ['required'],
        ]);

        $todo = Todo::create([
            'description' => $fields['description'],
            'state'       => 'Todo',
            'view_count'  => 1,
            'project_id'  => $fields['project_id'],
            'user_id'     => auth()->user()->id
        ]);

        return response()->json($todo);
    }

    public function update(Request $request, $projectId)
    {
        $fields = $request->all();

        $todo              = Todo::findOrFail($projectId);
        $todo->description = $fields['description'] ?? $todo->description;

        if (isset($fields['mark_done']) && $fields['mark_done'] == true) {
            $todo->markDone();
        }

        $todo->save();

        return response()->json($todo);
    }

    public function delete(Request $request, $projectId)
    {
        $todo = Todo::findOrFail($projectId);
        $todo->delete();

        return response()->noContent();
    }
}