<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index');
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.projects.index');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.projects.index');
    }

    public function show(Project $project): RedirectResponse
    {
        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project): RedirectResponse
    {
        return redirect()->route('admin.projects.index');
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        return redirect()->route('admin.projects.index');
    }

    public function destroy(Project $project): RedirectResponse
    {
        return redirect()->route('admin.projects.index');
    }
}
