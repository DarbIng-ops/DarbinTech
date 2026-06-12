<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PreRegistrationController extends Controller
{
    public function index(): View
    {
        return view('admin.pre-registrations.index');
    }

    public function update(Request $request, PreRegistration $preRegistration): RedirectResponse
    {
        $request->validate(['status' => 'required|in:pending,contacted,archived']);

        $preRegistration->update(['status' => $request->status]);

        return redirect()->back();
    }
}
