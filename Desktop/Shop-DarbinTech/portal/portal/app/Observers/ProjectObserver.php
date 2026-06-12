<?php

namespace App\Observers;

use App\Mail\ProjectDeliveredMail;
use App\Mail\ProjectReadyMail;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;

class ProjectObserver
{
    public function saving(Project $project): void
    {
        // Only trigger on updates where stage actually changed
        if (!$project->exists || !$project->isDirty('stage')) {
            return;
        }

        match ($project->stage) {
            'listo_para_entrega' => Mail::to($project->user->email)->send(new ProjectReadyMail($project)),
            'entregado'          => Mail::to($project->user->email)->send(new ProjectDeliveredMail($project)),
            default              => null,
        };
    }
}
