<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base font-semibold" style="color: var(--db-text);">Proyectos</h2>
        <button wire:click="openCreate"
            class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors"
            style="background-color: #F2B705; color: #111111;"
            onmouseover="this.style.backgroundColor='#D9A400'"
            onmouseout="this.style.backgroundColor='#F2B705'">
            + Nuevo proyecto
        </button>
    </div>

    @if ($projects->isEmpty())
        <div class="rounded-xl py-12 text-center text-sm"
             style="background-color: var(--db-surface); border: 1px solid var(--db-navy); color: var(--db-muted);">
            Este cliente no tiene proyectos todavía.
        </div>
    @else
        <div class="rounded-xl overflow-hidden" style="border: 1px solid var(--db-navy);">
            <table class="w-full text-sm text-left">
                <thead style="background-color: var(--db-surface); border-bottom: 1px solid var(--db-navy);">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide" style="color: var(--db-muted);">Proyecto</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide" style="color: var(--db-muted);">Etapa</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide" style="color: var(--db-muted);">Progreso</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide" style="color: var(--db-muted);">Revisiones</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr style="background-color: var(--db-bg); border-top: 1px solid var(--db-navy);">
                            <td class="px-6 py-4">
                                <p class="font-semibold" style="color: var(--db-text);">{{ $project->name }}</p>
                                @if ($project->description)
                                    <p class="text-xs mt-0.5 line-clamp-1" style="color: var(--db-muted);">{{ $project->description }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium"
                                      style="background-color: rgba(242,183,5,.15); color: #111111;">
                                    {{ $stages[$project->stage] ?? $project->stage }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-20 rounded-full h-1.5" style="background-color: var(--db-navy);">
                                        <div class="h-1.5 rounded-full transition-all"
                                             style="width: {{ $project->progress }}%; background-color: #F2B705;"></div>
                                    </div>
                                    <span class="text-xs" style="color: var(--db-muted);">{{ $project->progress }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm" style="color: var(--db-muted);">
                                {{ $project->revisions_used }}/{{ $project->revisions_allowed }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <button wire:click="openEdit({{ $project->id }})"
                                    class="text-sm font-medium"
                                    style="color: #F2B705;"
                                    onmouseover="this.style.color='#D9A400'"
                                    onmouseout="this.style.color='#F2B705'">
                                    Editar
                                </button>
                                <button wire:click="delete({{ $project->id }})"
                                    wire:confirm="¿Eliminar el proyecto '{{ $project->name }}'?"
                                    class="text-sm font-medium text-red-500 hover:text-red-700">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Modal de crear/editar proyecto --}}
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4"
             style="background-color: rgba(0,0,0,.5);">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">

                <h2 class="text-lg font-bold mb-5" style="color: #111111;">
                    {{ $editingId ? 'Editar proyecto' : 'Nuevo proyecto' }}
                </h2>

                <div class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium mb-1.5" style="color: #111111;">
                            Nombre del proyecto
                        </label>
                        <input wire:model="name" type="text"
                            class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                            style="border: 1px solid #E5E7EB; color: #111111;"
                            onfocus="this.style.borderColor='#F2B705'"
                            onblur="this.style.borderColor='#E5E7EB'">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1.5" style="color: #111111;">
                            Descripción
                        </label>
                        <textarea wire:model="description" rows="3"
                            class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors resize-none"
                            style="border: 1px solid #E5E7EB; color: #111111;"
                            onfocus="this.style.borderColor='#F2B705'"
                            onblur="this.style.borderColor='#E5E7EB'"></textarea>
                        @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1.5" style="color: #111111;">Etapa</label>
                        <select wire:model="stage"
                            class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                            style="border: 1px solid #E5E7EB; color: #111111;"
                            onfocus="this.style.borderColor='#F2B705'"
                            onblur="this.style.borderColor='#E5E7EB'">
                            @foreach ($stages as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('stage') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1.5" style="color: #111111;">
                            Progreso: <span style="color: #F2B705; font-weight: 700;">{{ $progress }}%</span>
                        </label>
                        <input wire:model.live="progress" type="range" min="0" max="100"
                            class="w-full" style="accent-color: #F2B705;">
                        @error('progress') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1.5" style="color: #111111;">
                                Revisiones permitidas
                            </label>
                            <input wire:model="revisionsAllowed" type="number" min="0" max="127"
                                class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                                style="border: 1px solid #E5E7EB; color: #111111;"
                                onfocus="this.style.borderColor='#F2B705'"
                                onblur="this.style.borderColor='#E5E7EB'">
                            @error('revisionsAllowed') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1.5" style="color: #111111;">
                                Revisiones usadas
                            </label>
                            <input wire:model="revisionsUsed" type="number" min="0" max="127"
                                class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                                style="border: 1px solid #E5E7EB; color: #111111;"
                                onfocus="this.style.borderColor='#F2B705'"
                                onblur="this.style.borderColor='#E5E7EB'">
                            @error('revisionsUsed') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button wire:click="$set('showModal', false)"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors"
                        style="color: #6B7280; background-color: #F9FAFB; border: 1px solid #E5E7EB;"
                        onmouseover="this.style.backgroundColor='#E5E7EB'"
                        onmouseout="this.style.backgroundColor='#F9FAFB'">
                        Cancelar
                    </button>
                    <button wire:click="save"
                        wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors"
                        style="background-color: #F2B705; color: #111111;"
                        onmouseover="this.style.backgroundColor='#D9A400'"
                        onmouseout="this.style.backgroundColor='#F2B705'">
                        <span wire:loading.remove wire:target="save">
                            {{ $editingId ? 'Guardar cambios' : 'Crear proyecto' }}
                        </span>
                        <span wire:loading wire:target="save">Guardando…</span>
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>
