<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Acceder — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" style="background-color: var(--db-bg); color: var(--db-text);">

<div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">

    {{-- Logo --}}
    <div class="mb-8 text-center">
        <a href="https://darbin.tech/" class="inline-block">
            <span class="text-2xl font-bold tracking-tight">
                <span style="color: var(--db-text);">Darbin</span><span style="color: var(--db-blue);">Tech</span>
            </span>
        </a>
        <p class="mt-1 text-sm" style="color: var(--db-muted);">Agencia de diseño y desarrollo web</p>
    </div>

    {{-- Grid de dos columnas --}}
    <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

        {{-- ============================================================ --}}
        {{-- Columna izquierda: Solicitar servicio                        --}}
        {{-- ============================================================ --}}
        <div class="rounded-2xl p-8" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">

            <h2 class="text-xl font-semibold mb-1" style="color: var(--db-text);">¿Tienes un proyecto en mente?</h2>
            <p class="text-sm mb-6" style="color: var(--db-muted);">
                Cuéntanos tu idea y nos pondremos en contacto contigo a la brevedad.
            </p>

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="mb-6 px-4 py-3 rounded-lg text-sm font-medium"
                     style="background-color: rgba(242,183,5,.15); border: 1px solid var(--db-green); color: var(--db-green);">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Errores de este formulario (solo si fue el último enviado) --}}
            @if ($errors->any() && old('form_origin') === 'pre-registro')
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
                <input type="hidden" name="form_origin" value="pre-registro">

                <div>
                    <label for="pr_name" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                        Nombre completo
                    </label>
                    <input id="pr_name" name="name" type="text"
                        value="{{ old('form_origin') === 'pre-registro' ? old('name') : '' }}"
                        required
                        class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                        style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                        onfocus="this.style.borderColor='var(--db-blue)'"
                        onblur="this.style.borderColor='var(--db-navy)'"
                        placeholder="Tu nombre">
                    @if (old('form_origin') === 'pre-registro')
                        @error('name')
                            <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <div>
                    <label for="pr_email" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                        Email
                    </label>
                    <input id="pr_email" name="email" type="email"
                        value="{{ old('form_origin') === 'pre-registro' ? old('email') : '' }}"
                        required
                        class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                        style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                        onfocus="this.style.borderColor='var(--db-blue)'"
                        onblur="this.style.borderColor='var(--db-navy)'"
                        placeholder="tu@email.com">
                    @if (old('form_origin') === 'pre-registro')
                        @error('email')
                            <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <div>
                    <label for="pr_idea" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                        Cuéntanos tu idea
                    </label>
                    <textarea id="pr_idea" name="idea" rows="4" required
                        class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors resize-none"
                        style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                        onfocus="this.style.borderColor='var(--db-blue)'"
                        onblur="this.style.borderColor='var(--db-navy)'"
                        placeholder="Describe tu proyecto: ¿qué necesitas?, ¿para cuándo?, ¿qué problema resuelve?">{{ old('form_origin') === 'pre-registro' ? old('idea') : '' }}</textarea>
                    @if (old('form_origin') === 'pre-registro')
                        @error('idea')
                            <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold transition-colors"
                    style="background-color: var(--db-blue); color: #111111;"
                    onmouseover="this.style.backgroundColor='#D9A400'"
                    onmouseout="this.style.backgroundColor='var(--db-blue)'">
                    Enviar mi idea
                </button>
            </form>
        </div>

        {{-- ============================================================ --}}
        {{-- Columna derecha: Login de cliente                            --}}
        {{-- ============================================================ --}}
        <div class="rounded-2xl p-8" style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">

            <h2 class="text-xl font-semibold mb-1" style="color: var(--db-text);">Ya tengo cuenta</h2>
            <p class="text-sm mb-6" style="color: var(--db-muted);">
                Iniciá sesión para acceder a tu panel de proyectos.
            </p>

            {{-- Status post-reseteo de contraseña --}}
            @if (session('status'))
                <div class="mb-6 px-4 py-3 rounded-lg text-sm font-medium"
                     style="background-color: rgba(242,183,5,.15); border: 1px solid var(--db-green); color: var(--db-green);">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errores de este formulario (solo si fue el último enviado) --}}
            @if ($errors->any() && old('form_origin') === 'login')
                <div class="mb-6 px-4 py-3 rounded-lg text-sm"
                     style="background-color: rgba(220,38,38,.1); border: 1px solid rgba(220,38,38,.4); color: #fca5a5;">
                    <ul class="space-y-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="form_origin" value="login">

                <div>
                    <label for="login_email" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                        Email
                    </label>
                    <input id="login_email" name="email" type="email"
                        value="{{ old('form_origin') === 'login' ? old('email') : '' }}"
                        required autofocus autocomplete="username"
                        class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                        style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                        onfocus="this.style.borderColor='var(--db-blue)'"
                        onblur="this.style.borderColor='var(--db-navy)'"
                        placeholder="tu@email.com">
                    @if (old('form_origin') === 'login')
                        @error('email')
                            <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <div>
                    <label for="login_password" class="block text-sm font-medium mb-1.5" style="color: var(--db-text);">
                        Contraseña
                    </label>
                    <input id="login_password" name="password" type="password"
                        required autocomplete="current-password"
                        class="w-full rounded-lg px-3.5 py-2.5 text-sm outline-none transition-colors"
                        style="background-color: var(--db-navy); border: 1px solid var(--db-navy); color: var(--db-text);"
                        onfocus="this.style.borderColor='var(--db-blue)'"
                        onblur="this.style.borderColor='var(--db-navy)'"
                        placeholder="••••••••">
                    @if (old('form_origin') === 'login')
                        @error('password')
                            <p class="mt-1 text-xs" style="color: #fca5a5;">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                            style="accent-color: var(--db-blue);">
                        <span class="text-sm" style="color: var(--db-muted);">Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-xs hover:underline"
                            style="color: var(--db-blue);">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold transition-colors"
                    style="background-color: var(--db-green); color: #111111;"
                    onmouseover="this.style.backgroundColor='#D9A400'"
                    onmouseout="this.style.backgroundColor='var(--db-green)'">
                    Iniciar sesión
                </button>
            </form>
        </div>

    </div>

</div>

</body>
</html>
