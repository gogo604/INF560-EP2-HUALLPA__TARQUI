
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis tours | TuriPotosí</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-surface">

    <!-- ENCABEZADO -->
    <header class="sticky top-0 z-40 border-b border-stone-200 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

            <a href="{{ route('home') }}" class="leading-tight">
                <span class="block text-2xl font-black text-ink">
                    Turi<span class="text-brand">Potosí</span>
                </span>
                <span class="block text-[10px] font-bold tracking-[0.2em] text-muted">
                    PANEL DEL GUÍA
                </span>
            </a>

            <nav class="flex flex-wrap items-center justify-end gap-2 text-sm font-bold">

                <a href="{{ route('dashboard') }}"
                   class="rounded-full px-4 py-2 text-muted hover:bg-brand-light hover:text-brand">
                    Mi panel
                </a>

                <a href="{{ route('guia.tours') }}"
                   class="rounded-full bg-brand-light px-4 py-2 text-brand">
                    Mis tours
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="rounded-full px-4 py-2 text-muted hover:bg-brand-light hover:text-brand">
                    Mi perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-full px-4 py-2 text-red-700 hover:bg-red-50">
                        Salir
                    </button>
                </form>

            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-10 lg:px-8">

        <!-- BIENVENIDA -->
        <div class="mb-8">
            <p class="text-xs font-black tracking-[0.2em] text-brand">
                ESPACIO DEL GUÍA
            </p>

            <h1 class="mt-2 text-3xl font-black text-ink sm:text-4xl">
                Mis tours asignados
            </h1>

            <p class="mt-3 text-muted">
                Bienvenido, {{ auth()->user()->name }}.
                Aquí puedes consultar las experiencias turísticas que tienes asignadas.
            </p>
        </div>

        <!-- RESUMEN -->
        <div class="mb-8 grid gap-5 sm:grid-cols-2">

            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold text-muted">
                    Tours asignados
                </p>

                <p class="mt-3 text-3xl font-black text-brand">
                    {{ $tours->total() }}
                </p>

                <p class="mt-2 text-sm text-muted">
                    Experiencias bajo tu responsabilidad.
                </p>
            </div>

            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold text-muted">
                    Tu cuenta
                </p>

                <p class="mt-3 text-xl font-black text-ink">
                    {{ auth()->user()->name }}
                </p>

                <p class="mt-2 text-sm text-muted">
                    {{ auth()->user()->email }}
                </p>
            </div>

        </div>

        <!-- LISTADO -->
        <section class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">

            <div class="border-b border-stone-100 bg-stone-50 px-6 py-5">
                <h2 class="text-lg font-black text-ink">
                    Experiencias asignadas
                </h2>

                <p class="mt-1 text-sm text-muted">
                    Consulta la información y disponibilidad de tus tours.
                </p>
            </div>

            <div class="p-6">

                @forelse ($tours as $tour)

                    <article class="mb-6 overflow-hidden rounded-2xl border border-stone-200 last:mb-0">

                        <div class="grid md:grid-cols-[240px_1fr]">

                            <!-- IMAGEN -->
                            <div class="min-h-52 bg-stone-100">
                                @if ($tour->imagen)
                                    <img
                                        src="{{ asset('storage/' . $tour->imagen) }}"
                                        alt="{{ $tour->titulo }}"
                                        class="h-full min-h-52 w-full object-cover"
                                    >
                                @else
                                    <div class="flex h-full min-h-52 items-center justify-center text-5xl">
                                        🏔️
                                    </div>
                                @endif
                            </div>

                            <!-- INFORMACIÓN -->
                            <div class="p-6">

                                <div class="flex flex-wrap items-start justify-between gap-3">

                                    <div>
                                        <span class="rounded-full bg-brand-light px-3 py-1 text-xs font-bold text-brand">
                                            {{ $tour->categoria->nombre }}
                                        </span>

                                        <h3 class="mt-3 text-xl font-black text-ink">
                                            {{ $tour->titulo }}
                                        </h3>
                                    </div>

                                    @if ($tour->activo)
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-800">
                                            Activo
                                        </span>
                                    @else
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-800">
                                            Inactivo
                                        </span>
                                    @endif

                                </div>

                                <p class="mt-3 text-sm leading-relaxed text-muted">
                                    {{ $tour->descripcion }}
                                </p>

                                <!-- DATOS -->
                                <div class="mt-5 grid gap-4 sm:grid-cols-3">

                                    <div class="rounded-xl bg-stone-50 p-4">
                                        <p class="text-xs font-semibold text-muted">Fecha de salida</p>
                                        <p class="mt-1 font-bold text-ink">
                                            {{ $tour->fecha_salida->format('d/m/Y H:i') }}
                                        </p>
                                    </div>

                                    <div class="rounded-xl bg-stone-50 p-4">
                                        <p class="text-xs font-semibold text-muted">Duración</p>
                                        <p class="mt-1 font-bold text-ink">
                                            {{ $tour->duracion_horas }} horas
                                        </p>
                                    </div>

                                    <div class="rounded-xl bg-stone-50 p-4">
                                        <p class="text-xs font-semibold text-muted">Precio por persona</p>
                                        <p class="mt-1 font-bold text-brand">
                                            Bs. {{ number_format($tour->precio, 2) }}
                                        </p>
                                    </div>

                                    <div class="rounded-xl bg-stone-50 p-4">
                                        <p class="text-xs font-semibold text-muted">Cupo máximo</p>
                                        <p class="mt-1 font-bold text-ink">
                                            {{ $tour->cupo_maximo }} personas
                                        </p>
                                    </div>

                                    <div class="rounded-xl bg-stone-50 p-4">
                                        <p class="text-xs font-semibold text-muted">Cupos disponibles</p>
                                        <p class="mt-1 font-bold text-green-700">
                                            {{ $tour->cuposDisponibles() }} personas
                                        </p>
                                    </div>

                                    <div class="rounded-xl bg-stone-50 p-4">
                                        <p class="text-xs font-semibold text-muted">Reservas registradas</p>
                                        <p class="mt-1 font-bold text-ink">
                                            {{ $tour->reservas->count() }}
                                        </p>
                                    </div>

                                </div>

                                <!-- SERVICIOS -->
                                <div class="mt-5">
                                    <p class="mb-3 text-sm font-bold text-ink">
                                        Servicios incluidos
                                    </p>

                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($tour->servicios as $servicio)
                                            <span class="rounded-full border border-stone-200 bg-white px-3 py-1.5 text-xs font-semibold text-muted">
                                                {{ $servicio->nombre }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-muted">
                                                No hay servicios registrados.
                                            </span>
                                        @endforelse
                                    </div>
                                </div>

                            </div>
                        </div>

                    </article>

                @empty

                    <div class="py-16 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-brand-light text-4xl">
                            🧭
                        </div>

                        <h3 class="mt-5 text-xl font-black text-ink">
                            Todavía no tienes tours asignados
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-muted">
                            Cuando el administrador te asigne una experiencia turística,
                            aparecerá aquí con toda su información.
                        </p>

                    </div>

                @endforelse

            </div>

            @if ($tours->hasPages())
                <div class="border-t border-stone-100 px-6 py-5">
                    {{ $tours->links() }}
                </div>
            @endif

        </section>

    </main>

    <footer class="mt-12 bg-ink py-8 text-center text-sm text-stone-400">
        © {{ date('Y') }} TuriPotosí · Panel del guía
    </footer>

</body>
</html>
