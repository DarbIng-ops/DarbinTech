<div>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Pre-registros</h1>
    </div>

    <div class="flex gap-1 mb-4 border-b border-gray-200">
        @foreach ([
            'all'       => 'Todos',
            'pending'   => 'Pendientes',
            'contacted' => 'Contactados',
            'archived'  => 'Archivados',
        ] as $value => $label)
            <button wire:click="$set('statusFilter', '{{ $value }}')"
                class="px-4 py-2 text-sm font-medium border-b-2 -mb-px transition-colors
                    {{ $statusFilter === $value
                        ? 'border-indigo-600 text-indigo-600'
                        : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                {{ $label }}
                @if ($value !== 'all' && isset($counts[$value]))
                    <span class="ml-1 px-1.5 py-0.5 rounded-full text-xs
                        {{ $statusFilter === $value ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">
                        {{ $counts[$value] }}
                    </span>
                @endif
            </button>
        @endforeach
    </div>

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
                    <tr class="hover:bg-gray-50">
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
                                    'archived'  => 'bg-gray-100 text-gray-500',
                                    default     => 'bg-gray-100 text-gray-500',
                                };
                                $statusLabel = match($item->status) {
                                    'pending'   => 'Pendiente',
                                    'contacted' => 'Contactado',
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
                            @if ($item->status !== 'contacted')
                                <button wire:click="markContacted({{ $item->id }})"
                                    class="text-xs font-medium text-green-600 hover:text-green-800">
                                    Contactado
                                </button>
                            @endif
                            @if ($item->status !== 'archived')
                                <button wire:click="markArchived({{ $item->id }})"
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
</div>
