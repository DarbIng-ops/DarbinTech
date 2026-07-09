<div class="space-y-6">
    <div>
        <a href="{{ route('dashboard') }}"
           class="text-sm font-medium"
           style="color: var(--db-muted);"
           onmouseover="this.style.color='var(--db-text)'"
           onmouseout="this.style.color='var(--db-muted)'">
            ← Mis proyectos
        </a>

        @if ($editing)
            <div class="mt-3 space-y-3">
                <div>
                    <input wire:model="name" type="text"
                        class="w-full rounded-lg px-3.5 py-2.5 text-lg font-bold outline-none transition-colors"
                        style="border: 1px solid #E5E7EB; color: #111111;"
                        onfocus="this.style.borderColor='#F2B705'"
                        onblur="this.style.borderColor='#E5E7EB'">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <textarea wire:model="description" rows="3"
                        class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors resize-none"
                        style="border: 1px solid #E5E7EB; color: #111111;"
                        onfocus="this.style.borderColor='#F2B705'"
                        onblur="this.style.borderColor='#E5E7EB'"
                        placeholder="Descripción del proyecto"></textarea>
                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-2">
                    <button wire:click="save"
                        wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors"
                        style="background-color: #F2B705; color: #111111;"
                        onmouseover="this.style.backgroundColor='#D9A400'"
                        onmouseout="this.style.backgroundColor='#F2B705'">
                        <span wire:loading.remove wire:target="save">Guardar</span>
                        <span wire:loading wire:target="save">Guardando…</span>
                    </button>
                    <button wire:click="$set('editing', false)"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors"
                        style="color: #6B7280; background-color: #F9FAFB; border: 1px solid #E5E7EB;"
                        onmouseover="this.style.backgroundColor='#E5E7EB'"
                        onmouseout="this.style.backgroundColor='#F9FAFB'">
                        Cancelar
                    </button>
                </div>
            </div>
        @else
            <div class="mt-2 flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold" style="color: var(--db-text);">{{ $project->name }}</h1>
                    @if ($project->description)
                        <p class="mt-1 text-sm" style="color: var(--db-muted);">{{ $project->description }}</p>
                    @endif
                </div>
                <button wire:click="startEdit"
                    class="shrink-0 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors"
                    style="border: 1px solid #E5E7EB; color: #6B7280;"
                    onmouseover="this.style.borderColor='#F2B705'; this.style.color='#111111';"
                    onmouseout="this.style.borderColor='#E5E7EB'; this.style.color='#6B7280';">
                    Editar información
                </button>
            </div>
        @endif
    </div>

    {{-- Progress --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Progreso general</h2>
            <span class="text-2xl font-bold text-indigo-600">{{ $project->progress }}%</span>
        </div>
        <div class="w-full bg-gray-100 rounded-full h-3">
            <div class="h-3 rounded-full bg-indigo-500 transition-all duration-500"
                style="width: {{ $project->progress }}%"></div>
        </div>
    </div>

    {{-- Stages timeline --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-6">Etapas del proyecto</h2>

        <ol class="flex items-start w-full overflow-x-auto pb-2">
            @foreach ($stages as $key => $label)
                @php
                    $isPast    = $loop->index < $currentStageIndex;
                    $isCurrent = $loop->index === $currentStageIndex;
                @endphp
                <li class="flex flex-col items-center {{ $loop->last ? 'shrink-0' : 'flex-1 min-w-0' }}">
                    <div class="flex items-center w-full">
                        <div class="flex items-center justify-center w-9 h-9 shrink-0 rounded-full z-10
                            {{ $isPast
                                ? 'bg-indigo-600 text-white'
                                : ($isCurrent
                                    ? 'bg-indigo-600 text-white ring-4 ring-indigo-100'
                                    : 'bg-white border-2 border-gray-300 text-gray-400') }}">
                            @if ($isPast)
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-xs font-bold">{{ $loop->iteration }}</span>
                            @endif
                        </div>
                        @if (!$loop->last)
                            <div class="flex-1 h-0.5
                                {{ $loop->index < $currentStageIndex ? 'bg-indigo-500' : 'bg-gray-200' }}">
                            </div>
                        @endif
                    </div>
                    <span class="mt-2 text-xs text-center px-1
                        {{ $isCurrent
                            ? 'text-indigo-600 font-semibold'
                            : ($isPast ? 'text-gray-600' : 'text-gray-400') }}">
                        {{ $label }}
                    </span>
                </li>
            @endforeach
        </ol>
    </div>

    {{-- Revisions --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Revisiones</h2>

        <div class="flex items-center gap-8">
            <div class="text-center">
                <p class="text-3xl font-bold text-gray-900">
                    {{ max(0, $project->revisions_allowed - $project->revisions_used) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">disponibles</p>
            </div>
            <div class="h-10 w-px bg-gray-200"></div>
            <div class="text-center">
                <p class="text-3xl font-bold text-gray-400">{{ $project->revisions_used }}</p>
                <p class="text-xs text-gray-500 mt-1">utilizadas</p>
            </div>
            <div class="h-10 w-px bg-gray-200"></div>
            <div class="text-center">
                <p class="text-3xl font-bold text-gray-300">{{ $project->revisions_allowed }}</p>
                <p class="text-xs text-gray-500 mt-1">totales</p>
            </div>
        </div>

        @if ($project->revisions_used >= $project->revisions_allowed)
            <p class="mt-4 text-sm text-amber-600 font-medium">
                Has utilizado todas las revisiones incluidas en tu plan.
            </p>
        @endif
    </div>
</div>
