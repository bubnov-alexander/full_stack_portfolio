<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['media', 'stacks.media'])->get();
        return ProjectResource::collection($projects);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->with(['media', 'stacks.media'])
            ->findOrFail($project->getKey());
        return new ProjectResource($project);
    }

}
