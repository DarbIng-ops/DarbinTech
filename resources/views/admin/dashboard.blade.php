@extends('layouts.portal')
@section('title', 'Dashboard')

@section('content')

<h1 class="text-xl font-semibold mb-6" style="color: var(--db-text);">Dashboard</h1>

{{-- Stat cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

    <div class="rounded-xl p-6" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-medium uppercase tracking-wide" style="color: var(--db-muted);">Clientes</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: var(--db-navy);">
                <svg class="w-4 h-4" style="color: var(--db-blue);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold" style="color: var(--db-text);">{{ $clientCount }}</p>
        <p class="text-xs mt-1" style="color: var(--db-muted);">usuarios registrados</p>
    </div>

    <div class="rounded-xl p-6" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-medium uppercase tracking-wide" style="color: var(--db-muted);">Proyectos</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: var(--db-navy);">
                <svg class="w-4 h-4" style="color: var(--db-blue);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold" style="color: var(--db-text);">{{ $projectCount }}</p>
        <p class="text-xs mt-1" style="color: var(--db-muted);">en total</p>
    </div>

    <div class="rounded-xl p-6" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-medium uppercase tracking-wide" style="color: var(--db-muted);">Pendientes</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(109,179,63,.15);">
                <svg class="w-4 h-4" style="color: var(--db-green);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold" style="color: var(--db-green);">{{ $preRegPending }}</p>
        <p class="text-xs mt-1" style="color: var(--db-muted);">por contactar</p>
    </div>

    <div class="rounded-xl p-6" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-medium uppercase tracking-wide" style="color: var(--db-muted);">Pre-registros</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: var(--db-navy);">
                <svg class="w-4 h-4" style="color: var(--db-blue);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold" style="color: var(--db-text);">{{ $preRegTotal }}</p>
        <p class="text-xs mt-1" style="color: var(--db-muted);">recibidos en total</p>
    </div>

</div>

{{-- Recent pre-registrations --}}
@if ($recentPreRegs->isNotEmpty())
<div class="rounded-xl overflow-hidden" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">
    <div class="flex items-center justify-between px-6 py-4" style="border-bottom: 1px solid var(--db-navy);">
        <h2 class="text-sm font-semibold" style="color: var(--db-text);">Últimos pre-registros</h2>
        <a href="{{ route('admin.pre-registrations.index') }}"
           class="text-xs font-medium transition-colors"
           style="color: var(--db-blue);"
           onmouseover="this.style.opacity='.75'"
           onmouseout="this.style.opacity='1'">
            Ver todos →
        </a>
    </div>
    <ul class="divide-y" style="border-color: var(--db-navy);">
        @foreach ($recentPreRegs as $item)
            <li class="flex items-center justify-between px-6 py-3">
                <div class="min-w-0">
                    <p class="text-sm font-medium truncate" style="color: var(--db-text);">{{ $item->name }}</p>
                    <p class="text-xs truncate" style="color: var(--db-muted);">{{ $item->email }}</p>
                </div>
                <span class="ml-4 shrink-0 inline-flex px-2 py-0.5 rounded-full text-xs font-medium
                    {{ $item->status === 'pending' ? 'bg-yellow-900/40 text-yellow-400' : ($item->status === 'contacted' ? 'bg-green-900/40 text-green-400' : 'bg-gray-700 text-gray-400') }}">
                    {{ match($item->status) { 'pending' => 'Pendiente', 'contacted' => 'Contactado', 'archived' => 'Archivado', default => $item->status } }}
                </span>
            </li>
        @endforeach
    </ul>
</div>
@endif

@endsection
