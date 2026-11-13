
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <p class="text-xs font-bold tracking-[.2em] text-red-700">
                    TU ESPACIO TURI POTOSÍ
                </p>
                <h1 class="mt-1 text-2xl font-black text-zinc-900">
                    Panel de control
                </h1>
                <p class="mt-1 text-sm text-zinc-500">
                    Gestiona tus actividades y descubre nuevas experiencias.
                </p>
            </div>

            <a href="{{ route('home') }}"
                class="inline-flex items-center justify-center rounded-xl bg-red-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-800">
                Ver sitio web ↗
            </a>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-9rem)] bg-[#fffaf9] px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <!-- Bienvenida -->
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-red-950 via-red-800 to-red-600 p-7 text-white shadow-xl sm:p-10">
                <div class="relative z-10 max-w-2xl">
                    <p class="text-xs font-bold tracking-[.2em] text-red-200">
                        HOLA, {{ strtoupper(auth()->user()->name) }}
                    </p>

                    <h2 class="mt-3 text-3xl font-black sm:text-4xl">
                        ¡Qué bueno tenerte aquí!
                    </h2>

                    <p class="mt-4 leading-relaxed text-red-100">
                        Bienvenido a TuriPotosí. Desde este espacio puedes gestionar tu cuenta y acceder a las herramientas disponibles.
                    </p>
                </div>

                <span class="absolute -right-4 -top-16 text-[220px] font-black leading-none text-white/10">
                    ✦
                </span>
            </section>

            <!-- Información de la cuenta -->
            <section class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-wider text-zinc-400">
                        Usuario
                    </p>
                    <p class="mt-2 text-lg font-extrabold text-zinc-900">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="mt-1 text-sm text-zinc-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <div class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-wider text-zinc-400">
                        Tipo de cuenta
                    </p>

                    <p class="mt-2 text-lg font-extrabold text-red-700">
                        @if(auth()->user()->hasRole('admin'))
                            Administrador
                        @elseif(auth()->user()->hasRole('guia'))
                            Guía turístico
                        @elseif(auth()->user()->hasRole('turista'))
                            Turista
                        @else
                            Usuario
                        @endif
                    </p>

                    <p class="mt-1 text-sm text-zinc-500">
                        Accesos disponibles según tu perfil.
                    </p>
                </div>
            </section>

            <!-- Accesos según el rol -->
            <div class="mt-9">
                <div class="mb-5">
                    <p class="text-xs font-bold tracking-[.2em] text-red-700">
                        ACCESOS RÁPIDOS
                    </p>
                    <h2 class="mt-1 text-2xl font-black text-zinc-900">
                        ¿Qué deseas hacer?
                    </h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

                    @if(auth()->user()->hasRole('admin'))

                        <a href="{{ route('admin.tours.index') }}"
                            class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg">
                            <span class="grid h-12 w-12 place-items-center rounded-xl bg-red-50 text-2xl text-red-700">▣</span>
                            <h3 class="mt-5 text-lg font-extrabold">Administrar tours</h3>
                            <p class="mt-2 text-sm leading-relaxed text-zinc-500">
                                Crea, edita y organiza las experiencias turísticas.
                            </p>
                            <p class="mt-5 font-bold text-red-700">Ir a tours →</p>
                        </a>

                        <a href="{{ route('admin.reservas.index') }}"
                            class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg">
                            <span class="grid h-12 w-12 place-items-center rounded-xl bg-red-50 text-2xl text-red-700">▤</span>
                            <h3 class="mt-5 text-lg font-extrabold">Reservas</h3>
                            <p class="mt-2 text-sm leading-relaxed text-zinc-500">
                                Consulta las reservas y actualiza sus estados.
                            </p>
                            <p class="mt-5 font-bold text-red-700">Gestionar reservas →</p>
                        </a>

                    @elseif(auth()->user()->hasRole('guia'))

                        <a href="{{ route('guia.tours') }}"
                            class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg">
                            <span class="grid h-12 w-12 place-items-center rounded-xl bg-red-50 text-2xl text-red-700">⌖</span>
                            <h3 class="mt-5 text-lg font-extrabold">Mis tours asignados</h3>
                            <p class="mt-2 text-sm leading-relaxed text-zinc-500">
                                Revisa fechas, detalles y reservas de tus recorridos.
                            </p>
                            <p class="mt-5 font-bold text-red-700">Ver mis tours →</p>
                        </a>

                    @elseif(auth()->user()->hasRole('turista'))

                        <a href="{{ route('tours.index') }}"
                            class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg">
                            <span class="grid h-12 w-12 place-items-center rounded-xl bg-red-50 text-2xl text-red-700">✦</span>
                            <h3 class="mt-5 text-lg font-extrabold">Explorar experiencias</h3>
                            <p class="mt-2 text-sm leading-relaxed text-zinc-500">
                                Encuentra tu próxima aventura por Potosí.
                            </p>
                            <p class="mt-5 font-bold text-red-700">Explorar tours →</p>
                        </a>

                        <a href="{{ route('reservas.mias') }}"
                            class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg">
                            <span class="grid h-12 w-12 place-items-center rounded-xl bg-red-50 text-2xl text-red-700">▤</span>
                            <h3 class="mt-5 text-lg font-extrabold">Mis reservas</h3>
                            <p class="mt-2 text-sm leading-relaxed text-zinc-500">
                                Consulta y administra tus reservas realizadas.
                            </p>
                            <p class="mt-5 font-bold text-red-700">Ver mis reservas →</p>
                        </a>

                    @else

                        <a href="{{ route('profile.edit') }}"
                            class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            <span class="grid h-12 w-12 place-items-center rounded-xl bg-red-50 text-2xl text-red-700">♙</span>
                            <h3 class="mt-5 text-lg font-extrabold">Mi perfil</h3>
                            <p class="mt-2 text-sm text-zinc-500">
                                Actualiza tus datos personales y contraseña.
                            </p>
                            <p class="mt-5 font-bold text-red-700">Editar perfil →</p>
                        </a>

                    @endif

                    <!-- Mi cuenta -->
                    <a href="{{ route('profile.edit') }}"
                        class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg">
                        <span class="grid h-12 w-12 place-items-center rounded-xl bg-red-50 text-2xl text-red-700">⚙</span>
                        <h3 class="mt-5 text-lg font-extrabold">Mi cuenta</h3>
                        <p class="mt-2 text-sm leading-relaxed text-zinc-500">
                            Administra tu información personal y seguridad.
                        </p>
                        <p class="mt-5 font-bold text-red-700">Configurar cuenta →</p>
                    </a>

                </div>
            </div>

            <!-- Invitación -->
            <section class="mt-9 flex flex-col justify-between gap-5 rounded-2xl border border-red-100 bg-red-50 p-7 sm:flex-row sm:items-center">
                <div>
                    <p class="text-xs font-bold tracking-[.2em] text-red-700">
                        DESCUBRE POTOSÍ
                    </p>
                    <h2 class="mt-2 text-2xl font-black text-zinc-900">
                        Hay mucho por explorar.
                    </h2>
                    <p class="mt-2 text-sm text-zinc-600">
                        Conoce lugares llenos de historia y vive experiencias que recordarás siempre.
                    </p>
                </div>

                <a href="{{ route('tours.index') }}"
                    class="shrink-0 rounded-xl bg-red-700 px-5 py-3 text-center font-bold text-white transition hover:bg-red-800">
                    Explorar destinos →
                </a>
            </section>

        </div>
    </div>
</x-app-layout>
