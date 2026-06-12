<div>
    <h2 class="text-xl font-semibold text-gray-900 mb-6">Mis proyectos</h2>

    @if ($projects->isEmpty())
        <div class="text-center py-16 text-gray-400">
            <p class="text-base">Aún no tienes proyectos asignados.</p>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <a href="{{ route('projects.show', $project) }}"
                    class="block bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md hover:border-indigo-100 transition-all">

                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-semibold text-gray-900 leading-snug">{{ $project->name }}</h3>
                        <span class="ml-2 shrink-0 inline-flex px-2 py-0.5 rounded-full text-xs font-medium
                            {{ $stageColors[$project->stage] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $stageLabels[$project->stage] ?? $project->stage }}
                        </span>
                    </div>

                    @if ($project->description)
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $project->description }}</p>
                    @endif

                    <div>
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Progreso</span>
                            <span class="font-medium text-gray-700">{{ $project->progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="h-2 rounded-full bg-indigo-500 transition-all" style="width: {{ $project->progress }}%"></div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
