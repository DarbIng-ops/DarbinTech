<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ClientProjectController extends Controller
{
    public function show(Project $project): View
    {
        abort_if($project->user_id !== auth()->id(), 403);

        return view('projects.show', compact('project'));
    }
}
