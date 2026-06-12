<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Proyectos</h1>
        <button wire:click="openCreate"
            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
            + Nuevo proyecto
        </button>
    </div>

    <div class="mb-4">
        <input wire:model.live.debounce.300ms="search" type="text"
            placeholder="Buscar proyecto..."
            class="w-full sm:w-80 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 font-medium">
                <tr>
                    <th class="px-6 py-3">Proyecto</th>
                    <th class="px-6 py-3">Cliente</th>
                    <th class="px-6 py-3">Etapa</th>
                    <th class="px-6 py-3">Progreso</th>
                    <th class="px-6 py-3">Revisiones</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($projects as $project)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $project->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $project->user->name }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                {{ $stages[$project->stage] ?? $project->stage }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-24 bg-gray-200 rounded-full h-1.5">
                                    <div class="h-1.5 rounded-full bg-indigo-500" style="width: {{ $project->progress }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $project->progress }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $project->revisions_used }}/{{ $project->revisions_allowed }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <button wire:click="openEdit({{ $project->id }})"
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                Editar
                            </button>
                            <button wire:click="delete({{ $project->id }})"
                                wire:confirm="¿Eliminar el proyecto '{{ $project->name }}'?"
                                class="text-sm font-medium text-red-500 hover:text-red-700">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            No se encontraron proyectos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $projects->links() }}</div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <h2 class="text-lg font-semibold text-gray-900 mb-5">
                    {{ $editingId ? 'Editar proyecto' : 'Nuevo proyecto' }}
                </h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <select wire:model="userId"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Seleccionar cliente...</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('userId') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del proyecto</label>
                        <input wire:model="name" type="text"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea wire:model="description" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Etapa</label>
                        <select wire:model="stage"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach ($stages as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('stage') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Progreso: <span class="text-indigo-600 font-semibold">{{ $progress }}%</span>
                        </label>
                        <input wire:model.live="progress" type="range" min="0" max="100"
                            class="w-full accent-indigo-600">
                        @error('progress') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Revisiones permitidas</label>
                            <input wire:model="revisionsAllowed" type="number" min="0" max="127"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('revisionsAllowed') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Revisiones usadas</label>
                            <input wire:model="revisionsUsed" type="number" min="0" max="127"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('revisionsUsed') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button wire:click="$set('showModal', false)"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancelar
                    </button>
                    <button wire:click="save"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        {{ $editingId ? 'Guardar cambios' : 'Crear proyecto' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
