@extends('layouts.portal')

@section('title', $user->name)

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <div>
        <a href="{{ route('admin.users.index') }}"
           class="inline-flex items-center gap-1 text-sm font-medium"
           style="color: var(--db-muted);"
           onmouseover="this.style.color='var(--db-text)'"
           onmouseout="this.style.color='var(--db-muted)'">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a usuarios
        </a>
    </div>

    {{-- Header del cliente --}}
    <div class="rounded-xl p-6" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">
        <div class="flex items-center gap-5">

            {{-- Avatar inicial --}}
            <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-bold shrink-0"
                 style="background-color: var(--db-navy); color: var(--db-blue);">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            {{-- Datos --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-bold tracking-tight" style="color: var(--db-text);">
                    {{ $user->name }}
                </h1>
                <p class="text-sm mt-0.5" style="color: var(--db-muted);">{{ $user->email }}</p>
            </div>

            {{-- Badges de rol y fecha --}}
            <div class="flex flex-col items-end gap-2 shrink-0">
                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold
                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ $user->role === 'admin' ? 'Admin' : 'Cliente' }}
                </span>
                <span class="text-xs" style="color: var(--db-muted);">
                    Registrado el {{ $user->created_at->format('d/m/Y') }}
                </span>
            </div>
        </div>

        {{-- Stats rápidas --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-6 pt-5"
             style="border-top: 1px solid var(--db-navy);">
            <div>
                <p class="text-xs uppercase tracking-widest font-semibold" style="color: var(--db-muted);">Proyectos</p>
                <p class="text-2xl font-bold mt-1" style="color: var(--db-text);">{{ $user->projects->count() }}</p>
            </div>
            @if ($user->projects->isNotEmpty())
                <div>
                    <p class="text-xs uppercase tracking-widest font-semibold" style="color: var(--db-muted);">Etapa actual</p>
                    <p class="text-sm font-semibold mt-1" style="color: var(--db-text);">
                        {{ \App\Livewire\Admin\ClientProjects::STAGES[$user->projects->first()->stage] ?? $user->projects->first()->stage }}
                    </p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest font-semibold" style="color: var(--db-muted);">Progreso</p>
                    <p class="text-2xl font-bold mt-1" style="color: #F2B705;">
                        {{ $user->projects->first()->progress }}%
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- Proyectos del cliente --}}
    <livewire:admin.client-projects :user="$user" />

</div>
@endsection
