<?php

namespace App\Livewire\Admin;

use App\Models\PreRegistration;
use Livewire\Component;
use Livewire\WithPagination;

class PreRegistrationList extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';

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

        return view('livewire.admin.pre-registration-list', [
            'preRegistrations' => $preRegistrations,
            'counts'           => $counts,
        ]);
    }
}
