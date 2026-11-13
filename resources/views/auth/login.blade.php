
<div class="mb-8 text-center">
    <span class="text-xs font-bold tracking-[.2em] text-red-700">
        BIENVENIDO DE NUEVO
    </span>

    <h1 class="mt-2 text-3xl font-black tracking-tight text-zinc-900">
        Iniciar sesión
    </h1>

    <p class="mt-2 text-sm text-zinc-500">
        Ingresa a tu cuenta para continuar tu experiencia en Potosí.
    </p>
</div>

<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <!-- Correo electrónico -->
    <div>
        <label for="email" class="mb-2 block text-sm font-semibold text-zinc-700">
            Correo electrónico
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="nombre@correo.com"
            required
            autofocus
            autocomplete="username"
            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-100"
        >

        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Contraseña -->
    <div>
        <div class="mb-2 flex items-center justify-between gap-3">
            <label for="password" class="text-sm font-semibold text-zinc-700">
                Contraseña
            </label>

            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="text-xs font-semibold text-red-700 hover:text-red-900"
                >
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <input
            id="password"
            type="password"
            name="password"
            placeholder="Ingresa tu contraseña"
            required
            autocomplete="current-password"
            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-100"
        >

        @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Recordar sesión -->
    <label class="flex cursor-pointer items-center gap-2 text-sm text-zinc-600">
        <input
            type="checkbox"
            name="remember"
            class="rounded border-zinc-300 text-red-700 focus:ring-red-600"
        >
        <span>Recordar mi sesión</span>
    </label>

    <!-- Botón -->
    <button
        type="submit"
        class="flex w-full items-center justify-center gap-3 rounded-xl bg-red-700 px-5 py-3.5 font-bold text-white shadow-lg shadow-red-700/20 transition hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2"
    >
        Ingresar a mi cuenta
        <span>→</span>
    </button>
</form>

@if (Route::has('register'))
    <div class="mt-7 border-t border-zinc-100 pt-6 text-center">
        <p class="text-sm text-zinc-500">
            ¿Todavía no tienes cuenta?
            <a
                href="{{ route('register') }}"
                class="font-bold text-red-700 hover:text-red-900"
            >
                Crear una cuenta
            </a>
        </p>
    </div>
@endif

<div class="mt-5 text-center">
    <a
        href="{{ route('home') }}"
        class="text-xs font-medium text-zinc-400 hover:text-red-700"
    >
        ← Volver al inicio
    </a>
</div>
