<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getAll(Request $request)
    {
        $projects = Project::get();

        return response()->json($projects);
    }

    public function getOne(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        return response()->json($project);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'   => ['required'],
        ]);

        $project = Project::create([
            'name'   => $fields['name'],
        ]);

        return response()->json($project);
    }

    public function update(Request $request, $projectId)
    {
        $fields = $request->validate([
            'name'   => ['required'],
        ]);

        $project = Project::findOrFail($projectId);
        $project->name = $fields['name'];
        $project->save();

        return response()->json($project);
    }
}