<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectManager extends Component
{
    use WithPagination;

    public const STAGES = [
        'briefing'           => 'Briefing',
        'wireframe'          => 'Wireframe',
        'diseno_ui'          => 'Diseño UI',
        'desarrollo'         => 'Desarrollo',
        'revision'           => 'Revisión',
        'listo_para_entrega' => 'Listo para entrega',
        'entregado'          => 'Entregado',
    ];

    public string $search    = '';
    public bool   $showModal = false;
    public ?int   $editingId = null;

    public ?int   $userId           = null;
    public string $name             = '';
    public string $description      = '';
    public string $stage            = 'briefing';
    public int    $progress         = 0;
    public int    $revisionsAllowed = 1;
    public int    $revisionsUsed    = 0;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openCreate(): void
    {
        $this->reset(['userId', 'name', 'description', 'editingId']);
        $this->stage            = 'briefing';
        $this->progress         = 0;
        $this->revisionsAllowed = 1;
        $this->revisionsUsed    = 0;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $project = Project::findOrFail($id);

        $this->editingId        = $id;
        $this->userId           = $project->user_id;
        $this->name             = $project->name;
        $this->description      = $project->description ?? '';
        $this->stage            = $project->stage;
        $this->progress         = $project->progress;
        $this->revisionsAllowed = $project->revisions_allowed;
        $this->revisionsUsed    = $project->revisions_used;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'userId'           => 'required|exists:users,id',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'stage'            => 'required|in:' . implode(',', array_keys(self::STAGES)),
            'progress'         => 'required|integer|min:0|max:100',
            'revisionsAllowed' => 'required|integer|min:0|max:127',
            'revisionsUsed'    => 'required|integer|min:0|max:127',
        ]);

        $data = [
            'user_id'          => $this->userId,
            'name'             => $this->name,
            'description'      => $this->description ?: null,
            'stage'            => $this->stage,
            'progress'         => $this->progress,
            'revisions_allowed' => $this->revisionsAllowed,
            'revisions_used'   => $this->revisionsUsed,
        ];

        if ($this->editingId) {
            Project::findOrFail($this->editingId)->update($data);
        } else {
            Project::create($data);
        }

        $this->showModal = false;
        $this->reset(['userId', 'name', 'description', 'editingId']);
        $this->stage            = 'briefing';
        $this->progress         = 0;
        $this->revisionsAllowed = 1;
        $this->revisionsUsed    = 0;
    }

    public function delete(int $id): void
    {
        Project::destroy($id);
    }

    public function render(): \Illuminate\View\View
    {
        $projects = Project::with('user')
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(15);

        $users = User::orderBy('name')->get(['id', 'name']);

        return view('livewire.admin.project-manager', [
            'projects' => $projects,
            'users'    => $users,
            'stages'   => self::STAGES,
        ]);
    }
}
