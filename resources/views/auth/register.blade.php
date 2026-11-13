
<x-guest-layout>
    <div class="mb-7">
        <span class="inline-flex items-center rounded-full bg-red-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-red-700">
            Únete a nosotros
        </span>

        <h1 class="mt-4 text-3xl font-black tracking-tight text-zinc-900">
            Crear una cuenta
        </h1>

        <p class="mt-2 text-sm leading-relaxed text-zinc-500">
            Regístrate y comienza a descubrir las experiencias que ofrece Potosí.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Nombre -->
        <div>
            <label for="name" class="mb-2 block text-sm font-semibold text-zinc-700">
                Nombre completo
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Escribe tu nombre completo"
                class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-100"
            >

            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

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
                required
                autocomplete="username"
                placeholder="ejemplo@correo.com"
                class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-100"
            >

            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label for="password" class="mb-2 block text-sm font-semibold text-zinc-700">
                Contraseña
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Crea una contraseña"
                class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-100"
            >

            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-zinc-700">
                Confirmar contraseña
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Repite tu contraseña"
                class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-100"
            >
        </div>

        <div class="rounded-xl border border-red-100 bg-red-50 p-4">
            <p class="text-sm font-bold text-red-800">
                Cuenta de turista
            </p>
            <p class="mt-1 text-xs leading-relaxed text-red-700">
                Al registrarte obtendrás una cuenta de turista para explorar tours y realizar reservas.
            </p>
        </div>

        <button
            type="submit"
            class="w-full rounded-xl bg-red-700 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-red-700/20 transition hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2"
        >
            Crear mi cuenta
        </button>
    </form>

    <div class="mt-7 border-t border-zinc-100 pt-6 text-center">
        <p class="text-sm text-zinc-500">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="font-bold text-red-700 hover:text-red-900">
                Inicia sesión
            </a>
        </p>

        <a href="{{ route('home') }}" class="mt-4 inline-block text-xs font-medium text-zinc-400 hover:text-red-700">
            ← Volver al inicio
        </a>
    </div>
</x-guest-layout>
