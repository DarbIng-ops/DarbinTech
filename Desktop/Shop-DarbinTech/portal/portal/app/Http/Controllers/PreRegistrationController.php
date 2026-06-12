<?php

namespace App\Http\Controllers;

use App\Models\PreRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PreRegistrationController extends Controller
{
    public function create(): View
    {
        return view('pre-registro.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'idea'  => 'required|string',
        ]);

        PreRegistration::create($request->only('name', 'email', 'idea'));

        return redirect()->route('pre-registro')
            ->with('success', '¡Gracias! Recibimos tu idea y nos pondremos en contacto pronto.');
    }
}
