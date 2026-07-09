<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" style="background-color: var(--db-bg); color: var(--db-text);">

<div class="flex h-screen overflow-hidden">

    {{-- ── Sidebar ─────────────────────────────────────────────────── --}}
    <aside class="flex flex-col w-64 shrink-0" style="background-color: var(--db-surface);">

        {{-- Logo --}}
        <div class="flex items-center h-16 px-6" style="border-bottom: 1px solid var(--db-navy);">
            <span class="text-xl font-bold tracking-tight select-none">
                <span style="color: var(--db-text);">Darbin</span><span style="color: var(--db-blue);">Tech</span>
            </span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto">
            @auth
                @php
                    $links = auth()->user()->isAdmin()
                        ? [
                            ['route' => 'admin.dashboard',               'pattern' => 'admin.dashboard',              'label' => 'Dashboard',      'icon' => 'M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z'],
                            ['route' => 'admin.users.index',              'pattern' => 'admin.users.*',                'label' => 'Usuarios',       'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                            ['route' => 'admin.projects.index',           'pattern' => 'admin.projects.*',             'label' => 'Proyectos',      'icon' => 'M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z'],
                            ['route' => 'admin.pre-registrations.index',  'pattern' => 'admin.pre-registrations.*',   'label' => 'Pre-registros',  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                          ]
                        : [
                            ['route' => 'dashboard', 'pattern' => 'dashboard', 'label' => 'Mis Proyectos', 'icon' => 'M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z'],
                          ];
                @endphp

                @foreach ($links as $link)
                    @php $active = request()->routeIs($link['pattern']); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all"
                       style="{{ $active
                           ? 'background-color: var(--db-navy); color: var(--db-text);'
                           : 'color: var(--db-muted);' }}"
                       onmouseover="if (!this.dataset.active) { this.style.backgroundColor='var(--db-navy)'; this.style.color='var(--db-text)'; }"
                       onmouseout="if (!this.dataset.active) { this.style.backgroundColor=''; this.style.color='var(--db-muted)'; }"
                       {{ $active ? 'data-active=1' : '' }}>
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                        </svg>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            @endauth
        </nav>

        {{-- User info & logout --}}
        <div class="px-4 py-4" style="border-top: 1px solid var(--db-navy);">
            @auth
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                         style="background-color: var(--db-navy); color: var(--db-blue);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold truncate" style="color: var(--db-text);">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs" style="color: var(--db-muted);">
                            {{ auth()->user()->isAdmin() ? 'Administrador' : 'Cliente' }}
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 text-xs px-2 py-1.5 rounded transition-colors"
                        style="color: var(--db-muted);"
                        onmouseover="this.style.color='var(--db-text)'; this.style.backgroundColor='var(--db-navy)';"
                        onmouseout="this.style.color='var(--db-muted)'; this.style.backgroundColor='';">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Cerrar sesión
                    </button>
                </form>
            @endauth
        </div>
    </aside>

    {{-- ── Main content ──────────────────────────────────────────────── --}}
    <main class="flex-1 overflow-y-auto p-8" style="background-color: var(--db-bg);">
        @yield('content')
    </main>

</div>

</body>
</html>
