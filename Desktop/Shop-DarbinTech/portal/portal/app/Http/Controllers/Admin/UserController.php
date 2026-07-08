<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index');
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function show(User $user): View
    {
        $user->load('projects');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }
}
