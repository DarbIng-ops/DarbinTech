<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreRegistration;
use App\Models\Project;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'clientCount'   => User::where('role', 'client')->count(),
            'projectCount'  => Project::count(),
            'preRegTotal'   => PreRegistration::count(),
            'preRegPending' => PreRegistration::where('status', 'pending')->count(),
            'recentPreRegs' => PreRegistration::latest()->limit(5)->get(),
        ]);
    }
}
