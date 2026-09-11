<?php

namespace App\Http\Controllers;

use App\Mail\NewLeadNotificationMail;
use App\Mail\PreRegistrationReceivedMail;
use App\Models\PreRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'idea'    => 'required|string',
            'consent' => 'accepted',
        ]);

        $preRegistration = PreRegistration::create($request->only('name', 'email', 'idea'));

        Mail::to($preRegistration->email)
            ->send(new PreRegistrationReceivedMail($preRegistration));

        Mail::to(['alirioportilla96@gmail.com', 'info@darbin.tech'])
            ->send(new NewLeadNotificationMail($preRegistration));

        return redirect()->route('acceder')
            ->with('success', '¡Gracias! Recibimos tu idea y nos pondremos en contacto pronto.');
    }
}
