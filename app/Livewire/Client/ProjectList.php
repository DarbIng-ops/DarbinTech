<?php

namespace App\Livewire\Client;

use Livewire\Component;

class ProjectList extends Component
{
    public const STAGE_LABELS = [
        'briefing'           => 'Briefing',
        'wireframe'          => 'Wireframe',
        'diseno_ui'          => 'Diseño UI',
        'desarrollo'         => 'Desarrollo',
        'revision'           => 'Revisión',
        'listo_para_entrega' => 'Listo para entrega',
        'entregado'          => 'Entregado',
    ];

    public const STAGE_COLORS = [
        'briefing'           => 'bg-gray-100 text-gray-600',
        'wireframe'          => 'bg-blue-100 text-blue-700',
        'diseno_ui'          => 'bg-purple-100 text-purple-700',
        'desarrollo'         => 'bg-yellow-100 text-yellow-700',
        'revision'           => 'bg-orange-100 text-orange-700',
        'listo_para_entrega' => 'bg-green-100 text-green-700',
        'entregado'          => 'bg-emerald-100 text-emerald-700',
    ];

    public function render(): \Illuminate\View\View
    {
        $projects = auth()->user()->projects()->latest()->get();

        return view('livewire.client.project-list', [
            'projects'    => $projects,
            'stageLabels' => self::STAGE_LABELS,
            'stageColors' => self::STAGE_COLORS,
        ]);
    }
}
