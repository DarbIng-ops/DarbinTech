<?php

namespace App\Livewire\Client;

use App\Models\Project;
use Livewire\Component;

class ProjectDetail extends Component
{
    public Project $project;

    public bool   $editing     = false;
    public string $name        = '';
    public string $description = '';

    public const STAGES = [
        'briefing'           => 'Briefing',
        'wireframe'          => 'Wireframe',
        'diseno_ui'          => 'Diseño UI',
        'desarrollo'         => 'Desarrollo',
        'revision'           => 'Revisión',
        'listo_para_entrega' => 'Listo para entrega',
        'entregado'          => 'Entregado',
    ];

    public function mount(Project $project): void
    {
        // Autorización aquí (no en Policy) porque Livewire inyecta el modelo directamente
        // desde la URL — sin este chequeo, cualquier cliente autenticado podría ver
        // proyectos ajenos con solo cambiar el ID en la ruta.
        abort_if($project->user_id !== auth()->id(), 403);
        $this->project = $project;
    }

    public function startEdit(): void
    {
        $this->name        = $this->project->name;
        $this->description = $this->project->description ?? '';
        $this->resetValidation();
        $this->editing = true;
    }

    public function save(): void
    {
        $this->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->project->update([
            'name'        => $this->name,
            'description' => $this->description ?: null,
        ]);

        $this->editing = false;
    }

    public function render(): \Illuminate\View\View
    {
        $stageKeys         = array_keys(self::STAGES);
        $currentStageIndex = (int) array_search($this->project->stage, $stageKeys);

        return view('livewire.client.project-detail', [
            'stages'            => self::STAGES,
            'currentStageIndex' => $currentStageIndex,
        ]);
    }
}
