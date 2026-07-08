<?php

namespace App\Livewire\Admin;

use App\Mail\ProjectAcceptedMail;
use App\Models\PreRegistration;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class PreRegistrationList extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';

    public ?int $selectedId = null;
    public string $newUserPassword = '';
    public string $projectName = '';
    public string $projectDescription = '';
    public string $successMessage = '';

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function markContacted(int $id): void
    {
        PreRegistration::findOrFail($id)->update(['status' => 'contacted']);
    }

    public function markArchived(int $id): void
    {
        PreRegistration::findOrFail($id)->update(['status' => 'archived']);
    }

    public function openDetail(int $id): void
    {
        $item = PreRegistration::findOrFail($id);
        $this->selectedId     = $id;
        $this->successMessage = '';

        if ($item->user_id === null) {
            $this->newUserPassword    = Str::random(10);
            $this->projectName        = "Proyecto de {$item->name}";
            $this->projectDescription = $item->idea;
        }
    }

    public function closeModal(): void
    {
        $this->selectedId         = null;
        $this->newUserPassword    = '';
        $this->projectName        = '';
        $this->projectDescription = '';
        $this->resetValidation();
    }

    public function createUserAndProject(): void
    {
        $this->validate([
            'projectName'        => ['required', 'string', 'min:3', 'max:255'],
            'projectDescription' => ['required', 'string', 'min:10'],
            'newUserPassword'    => ['required', 'string', 'min:8'],
        ], [
            'projectName.required'        => 'El nombre del proyecto es obligatorio.',
            'projectName.min'             => 'El nombre debe tener al menos 3 caracteres.',
            'projectDescription.required' => 'La descripción es obligatoria.',
            'projectDescription.min'      => 'La descripción debe tener al menos 10 caracteres.',
            'newUserPassword.required'    => 'La contraseña es obligatoria.',
            'newUserPassword.min'         => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $item = PreRegistration::findOrFail($this->selectedId);

        $user = User::create([
            'name'                 => $item->name,
            'email'                => $item->email,
            'password'             => $this->newUserPassword,
            'role'                 => 'client',
            'must_change_password' => true,
        ]);

        Project::create([
            'user_id'           => $user->id,
            'name'              => $this->projectName,
            'description'       => $this->projectDescription,
            'stage'             => 'briefing',
            'progress'          => 0,
            'revisions_allowed' => 1,
            'revisions_used'    => 0,
        ]);

        $item->update([
            'user_id' => $user->id,
            'status'  => 'contacted',
        ]);

        // $newUserPassword se mantiene en estado para ser usado en approve()
    }

    public function approve(int $id): void
    {
        $item    = PreRegistration::with('user.projects')->findOrFail($id);
        $user    = $item->user;
        $project = $user->projects()->latest()->first();

        Mail::to($user->email)->send(
            new ProjectAcceptedMail($user, $project, $this->newUserPassword)
        );

        $item->update(['status' => 'approved']);

        $emailDestino          = $user->email;
        $this->selectedId      = null;
        $this->projectName     = '';
        $this->projectDescription = '';
        $this->newUserPassword = '';
        $this->successMessage  = "✓ Email enviado a {$emailDestino}. Pre-registro marcado como Aprobado.";
    }

    public function render(): \Illuminate\View\View
    {
        $preRegistrations = PreRegistration::query()
            ->when($this->statusFilter !== 'all', fn ($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(20);

        $counts = PreRegistration::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $selectedItem = $this->selectedId
            ? PreRegistration::with('user.projects')->find($this->selectedId)
            : null;

        return view('livewire.admin.pre-registration-list', [
            'preRegistrations' => $preRegistrations,
            'counts'           => $counts,
            'selectedItem'     => $selectedItem,
        ]);
    }
}
