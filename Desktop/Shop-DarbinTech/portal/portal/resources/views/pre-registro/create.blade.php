<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pre-registro — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" style="background-color: var(--db-bg); color: var(--db-text);">

<div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">

    {{-- Logo --}}
    <div class="mb-8 text-center">
        <span class="text-2xl font-bold tracking-tight">
            <span style="color: var(--db-text);">Darbin</span><span style="color: var(--db-blue);">Tech</span>
        </span>
        <p class="mt-1 text-sm" style="color: var(--db-muted);">Agencia de diseño y desarrollo web</p>
    </div>

    {{-- Form card --}}
    <div class="w-full max-w-lg rounded-2xl p-8" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">

        <h1 class="text-xl font-semibold mb-1" style="color: var(--db-text);">¿Tienes un proyecto en mente?</h1>
        <p class="text-sm mb-6" style="color: var(--db-muted);">
            Cuéntanos tu idea y nos pondremos en contacto contigo a la brevedad.
        </p>

        {{-- Success message --}}
        @if (session('success'))
            <div class="mb-6 px-4 py-3 rounded-lg text-sm font-medium"
                 style="background-color: rgba(109,179,63,.15); border: 1px solid var(--db-green); color: var(--db-green);">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-6 px-4 py-3 rounded-lg text-sm"
                 style="background-color: rgba(220,38,38,.1); border: 1px solid rgba(220,38,38,.4); color: #fca5a5;">
                <ul class="space-y-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pre-registro.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                    Nombre completo
                </label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                    style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                    onfocus="this.style.borderColor='var(--db-blue)'"
                    onblur="this.style.borderColor='var(--db-navy)'"
                    placeholder="Tu nombre">
                @error('name')
                    <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                    Email
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                    style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                    onfocus="this.style.borderColor='var(--db-blue)'"
                    onblur="this.style.borderColor='var(--db-navy)'"
                    placeholder="tu@email.com">
                @error('email')
                    <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="idea" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                    Cuéntanos tu idea
                </label>
                <textarea id="idea" name="idea" rows="4" required
                    class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors resize-none"
                    style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                    onfocus="this.style.borderColor='var(--db-blue)'"
                    onblur="this.style.borderColor='var(--db-navy)'"
                    placeholder="Describe tu proyecto: ¿qué necesitas?, ¿para cuándo?, ¿qué problema resuelve?">{{ old('idea') }}</textarea>
                @error('idea')
                    <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold transition-opacity"
                style="background-color: var(--db-blue); color: #fff;"
                onmouseover="this.style.opacity='.88'"
                onmouseout="this.style.opacity='1'">
                Enviar mi idea
            </button>
        </form>
    </div>

    <p class="mt-6 text-xs" style="color: var(--db-muted);">
        ¿Ya tienes cuenta?
        <a href="{{ route('acceder') }}" style="color: var(--db-blue);" class="hover:underline">Inicia sesión</a>
    </p>

</div>

</body>
</html>
