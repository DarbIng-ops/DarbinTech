<div>

    {{-- Flash de éxito (persiste después de cerrar el modal) --}}
    @if ($successMessage)
        <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium flex items-center justify-between"
             style="background-color:rgba(242,183,5,.12);border:1px solid #F2B705;color:#111111;">
            <span>{{ $successMessage }}</span>
            <button wire:click="$set('successMessage', '')"
                class="ml-4 text-gray-500 hover:text-gray-700 text-lg leading-none">&times;</button>
        </div>
    @endif

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Pre-registros</h1>
    </div>

    {{-- Tabs de filtro --}}
    <div class="flex gap-1 mb-4 border-b border-gray-200">
        @foreach ([
            'all'       => 'Activos',
            'pending'   => 'Pendientes',
            'contacted' => 'Contactados',
            'approved'  => 'Aprobados',
            'archived'  => 'Archivados',
        ] as $value => $label)
            <button wire:click="$set('statusFilter', '{{ $value }}')"
                class="px-4 py-2 text-sm font-medium border-b-2 -mb-px transition-colors
                    {{ $statusFilter === $value
                        ? 'border-[#F2B705] text-[#111111]'
                        : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                {{ $label }}
                @if ($value !== 'all' && isset($counts[$value]))
                    <span class="ml-1 px-1.5 py-0.5 rounded-full text-xs
                        {{ $statusFilter === $value
                            ? 'text-[#111111]'
                            : 'bg-gray-100 text-gray-500' }}"
                          style="{{ $statusFilter === $value ? 'background-color:rgba(242,183,5,.2);' : '' }}">
                        {{ $counts[$value] }}
                    </span>
                @endif
            </button>
        @endforeach
    </div>

    {{-- Tabla --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 font-medium">
                <tr>
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Idea</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($preRegistrations as $item)
                    <tr wire:click="openDetail({{ $item->id }})"
                        class="hover:bg-gray-50 cursor-pointer">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->email }}</td>
                        <td class="px-6 py-4 text-gray-600 max-w-xs">
                            <span title="{{ $item->idea }}">{{ Str::limit($item->idea, 80) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badge = match($item->status) {
                                    'pending'   => 'bg-yellow-100 text-yellow-700',
                                    'contacted' => 'bg-green-100 text-green-700',
                                    'approved'  => 'bg-emerald-100 text-emerald-800',
                                    'archived'  => 'bg-gray-100 text-gray-500',
                                    default     => 'bg-gray-100 text-gray-500',
                                };
                                $statusLabel = match($item->status) {
                                    'pending'   => 'Pendiente',
                                    'contacted' => 'Contactado',
                                    'approved'  => 'Aprobado',
                                    'archived'  => 'Archivado',
                                    default     => $item->status,
                                };
                            @endphp
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            @if ($item->status !== 'contacted' && $item->status !== 'approved')
                                <button wire:click.stop="markContacted({{ $item->id }})"
                                    class="text-xs font-medium text-green-600 hover:text-green-800">
                                    Contactado
                                </button>
                            @endif
                            @if ($item->status !== 'archived')
                                <button wire:click.stop="markArchived({{ $item->id }})"
                                    class="text-xs font-medium text-gray-400 hover:text-gray-600">
                                    Archivar
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            No hay pre-registros en esta categoría.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $preRegistrations->links() }}</div>

    {{-- ============================================================ --}}
    {{-- Modal de detalle (renderizado condicional nativo de Livewire) --}}
    {{-- ============================================================ --}}
    @if ($selectedItem)
    <div wire:key="modal-{{ $selectedItem->id }}"
         class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">

        {{-- Fondo oscuro --}}
        <div class="fixed inset-0" wire:click="closeModal">
            <div class="absolute inset-0 bg-gray-600 opacity-60"></div>
        </div>

        {{-- Panel --}}
        <div class="relative bg-white rounded-xl overflow-hidden shadow-2xl sm:max-w-2xl sm:w-full sm:mx-auto">

            {{-- Header --}}
            <div class="px-6 py-4 flex items-start justify-between"
                 style="border-bottom:1px solid #E5E7EB;">
                <div>
                    <h2 class="text-lg font-bold" style="color:#111111;">{{ $selectedItem->name }}</h2>
                    <p class="text-sm mt-0.5" style="color:#6B7280;">{{ $selectedItem->email }}</p>
                </div>
                <button wire:click="closeModal"
                    class="ml-4 text-gray-400 hover:text-gray-600 text-2xl leading-none"
                    aria-label="Cerrar">&times;</button>
            </div>

            {{-- Idea completa --}}
            <div class="px-6 py-4" style="border-bottom:1px solid #F9FAFB;">
                <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#6B7280;">
                    Idea del proyecto
                </p>
                <p class="text-sm leading-relaxed whitespace-pre-wrap" style="color:#111111;">{{ $selectedItem->idea }}</p>
            </div>

            {{-- ---- Estado 1: ya aprobado ---- --}}
            @if ($selectedItem->status === 'approved')
                <div class="px-6 py-8 text-center">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                        ✓ Ya notificado al cliente
                    </span>
                </div>

            {{-- ---- Estado 2: usuario vinculado, listo para aprobar ---- --}}
            @elseif ($selectedItem->user_id !== null)
                <div class="px-6 py-6 space-y-4">
                    <div class="rounded-lg p-4" style="background-color:#F9FAFB;border:1px solid #E5E7EB;">
                        <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#6B7280;">
                            Cliente vinculado
                        </p>
                        <p class="text-sm" style="color:#111111;">
                            <span class="font-medium">Email:</span> {{ $selectedItem->user->email }}
                        </p>
                        @if ($selectedItem->user->projects->isNotEmpty())
                            <p class="text-sm mt-1" style="color:#111111;">
                                <span class="font-medium">Proyecto:</span> {{ $selectedItem->user->projects->first()->name }}
                            </p>
                        @endif
                    </div>

                    @if ($newUserPassword)
                        {{-- Cliente nuevo: aprobar envía email con credenciales --}}
                        <button wire:click="approve({{ $selectedItem->id }})"
                            wire:loading.attr="disabled"
                            class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold transition-colors"
                            style="background-color:#F2B705;color:#111111;"
                            onmouseover="this.style.backgroundColor='#D9A400'"
                            onmouseout="this.style.backgroundColor='#F2B705'">
                            <span wire:loading.remove wire:target="approve">Aprobar y notificar al cliente</span>
                            <span wire:loading wire:target="approve">Enviando email…</span>
                        </button>
                    @else
                        {{-- Cliente ya existente o creado manualmente: aprobar sin email --}}
                        <div class="rounded-lg px-4 py-3 text-sm"
                             style="background-color:rgba(242,183,5,.1);border:1px solid #F2B705;color:#111111;">
                            Este cliente ya tenía cuenta. Al aprobar no se enviará email de bienvenida con contraseña.
                        </div>
                        <button wire:click="approve({{ $selectedItem->id }})"
                            wire:loading.attr="disabled"
                            class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold transition-colors"
                            style="background-color:#F2B705;color:#111111;"
                            onmouseover="this.style.backgroundColor='#D9A400'"
                            onmouseout="this.style.backgroundColor='#F2B705'">
                            <span wire:loading.remove wire:target="approve">Marcar como aprobado</span>
                            <span wire:loading wire:target="approve">Procesando…</span>
                        </button>
                    @endif
                </div>

            {{-- ---- Estado 3: sin usuario, crear primero ---- --}}
            @else
                <div class="px-6 py-6 space-y-4">

                    {{-- Aviso: el email ya pertenece a un cliente existente --}}
                    @if ($existingUserForSelected)
                        <div class="rounded-lg px-4 py-3 text-sm"
                             style="background-color:rgba(242,183,5,.1);border:1px solid #F2B705;color:#111111;">
                            <p class="font-semibold mb-1">Este email ya pertenece a un cliente existente</p>
                            <p>El cliente <strong>{{ $existingUserForSelected->name }}</strong>
                            ({{ $existingUserForSelected->email }}) ya tiene cuenta.
                            Al continuar se creará un nuevo proyecto para ese cliente
                            sin generar una cuenta ni contraseña nueva.</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium mb-1.5" style="color:#111111;">
                            Nombre del proyecto
                        </label>
                        <input wire:model="projectName" type="text"
                            class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                            style="border:1px solid #E5E7EB;color:#111111;"
                            onfocus="this.style.borderColor='#F2B705'"
                            onblur="this.style.borderColor='#E5E7EB'"
                            placeholder="Nombre del proyecto">
                        @error('projectName')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1.5" style="color:#111111;">
                            Descripción del proyecto
                        </label>
                        <textarea wire:model="projectDescription" rows="3"
                            class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors resize-none"
                            style="border:1px solid #E5E7EB;color:#111111;"
                            onfocus="this.style.borderColor='#F2B705'"
                            onblur="this.style.borderColor='#E5E7EB'"
                            placeholder="Descripción del proyecto"></textarea>
                        @error('projectDescription')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo de contraseña solo para clientes nuevos --}}
                    @if (!$existingUserForSelected)
                        <div>
                            <label class="block text-sm font-medium mb-1.5" style="color:#111111;">
                                Contraseña generada
                            </label>
                            <input wire:model="newUserPassword" type="text"
                                class="w-full rounded-lg px-3.5 py-2.5 text-sm font-mono outline-none transition-colors"
                                style="border:1px solid #E5E7EB;color:#111111;background-color:#F9FAFB;"
                                onfocus="this.style.borderColor='#F2B705'"
                                onblur="this.style.borderColor='#E5E7EB'"
                                placeholder="Contraseña">
                            <p class="mt-1 text-xs" style="color:#6B7280;">
                                Podés editarla antes de crear el usuario.
                            </p>
                            @error('newUserPassword')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <button wire:click="createUserAndProject()"
                        wire:loading.attr="disabled"
                        class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold transition-colors"
                        style="background-color:#F2B705;color:#111111;"
                        onmouseover="this.style.backgroundColor='#D9A400'"
                        onmouseout="this.style.backgroundColor='#F2B705'">
                        @if ($existingUserForSelected)
                            <span wire:loading.remove wire:target="createUserAndProject">Crear proyecto para cliente existente</span>
                        @else
                            <span wire:loading.remove wire:target="createUserAndProject">Crear usuario y proyecto</span>
                        @endif
                        <span wire:loading wire:target="createUserAndProject">Creando…</span>
                    </button>

                </div>
            @endif

        </div>
    </div>
    @endif

</div>
