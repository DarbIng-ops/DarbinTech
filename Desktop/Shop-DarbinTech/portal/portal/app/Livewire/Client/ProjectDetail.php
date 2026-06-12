<?php

namespace App\Livewire\Client;

use App\Models\Project;
use Livewire\Component;

class ProjectDetail extends Component
{
    public Project $project;

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
        abort_if($project->user_id !== auth()->id(), 403);
        $this->project = $project;
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
