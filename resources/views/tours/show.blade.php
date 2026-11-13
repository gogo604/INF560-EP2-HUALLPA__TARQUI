
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tour->titulo }} | TuriPotosí</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-surface text-ink">

    {{-- ENCABEZADO --}}
    <header class="sticky top-0 z-40 border-b border-stone-200 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

            <a href="{{ route('home') }}" class="shrink-0 leading-tight">
                <span class="block text-2xl font-black">
                    Turi<span class="text-brand">Potosí</span>
                </span>
                <span class="block text-[10px] font-bold tracking-[0.2em] text-muted">
                    DESCUBRE · VIAJA · VIVE
                </span>
            </a>

            <nav class="flex flex-wrap items-center justify-end gap-2 text-sm font-bold">

                <a href="{{ route('home') }}"
                   class="rounded-full px-4 py-2 text-muted transition hover:bg-brand-light hover:text-brand">
                    Inicio
                </a>

                <a href="{{ route('tours.index') }}"
                   class="rounded-full bg-brand-light px-4 py-2 text-brand">
                    Tours
                </a>

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="rounded-full px-4 py-2 text-muted transition hover:bg-brand-light hover:text-brand">
                        Mi panel
                    </a>

                    @if(auth()->user()->hasRole('turista'))
                        <a href="{{ route('reservas.mias') }}"
                           class="rounded-full px-4 py-2 text-muted transition hover:bg-brand-light hover:text-brand">
                            Mis reservas
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.tours.index') }}"
                           class="rounded-full px-4 py-2 text-muted transition hover:bg-brand-light hover:text-brand">
                            Administración
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('guia'))
                        <a href="{{ route('guia.tours') }}"
                           class="rounded-full px-4 py-2 text-muted transition hover:bg-brand-light hover:text-brand">
                            Mis tours
                        </a>
                    @endif

                    <a href="{{ route('profile.edit') }}"
                       class="rounded-full px-4 py-2 text-muted transition hover:bg-brand-light hover:text-brand">
                        Mi perfil
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-full px-4 py-2 text-muted transition hover:bg-brand-light hover:text-brand">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-full bg-brand px-5 py-2.5 text-white transition hover:bg-brand-dark">
                        Registrarse
                    </a>
                @endauth

            </nav>
        </div>
    </header>

    {{-- IMAGEN PRINCIPAL --}}
    <section class="relative h-72 overflow-hidden bg-ink sm:h-96 lg:h-[460px]">

        <img
            src="{{ $tour->imagen ? asset('storage/'.$tour->imagen) : asset('images/potosi-hero.jpg') }}"
            alt="{{ $tour->titulo }}"
            class="h-full w-full object-cover"
        >

        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-black/10"></div>

        <div class="absolute inset-x-0 bottom-0 mx-auto max-w-7xl px-5 pb-10 lg:px-8">

            <span class="inline-block rounded-full bg-brand px-4 py-2 text-xs font-black text-white">
                {{ $tour->categoria?->nombre ?? 'Experiencia turística' }}
            </span>

            <h1 class="mt-4 max-w-4xl text-3xl font-black leading-tight text-white sm:text-5xl">
                {{ $tour->titulo }}
            </h1>

            <p class="mt-3 text-sm font-medium text-stone-200 sm:text-base">
                Descubre una experiencia inolvidable en Potosí.
            </p>

        </div>
    </section>

    {{-- CONTENIDO --}}
    <main class="mx-auto max-w-7xl px-5 py-12 lg:px-8">

        <a href="{{ route('tours.index') }}"
           class="inline-flex items-center gap-2 font-bold text-brand transition hover:text-brand-dark">
            ← Volver al catálogo
        </a>

        <div class="mt-8 grid gap-8 lg:grid-cols-3">

            {{-- INFORMACIÓN DEL TOUR --}}
            <div class="space-y-8 lg:col-span-2">

                <section class="rounded-3xl border border-stone-200 bg-white p-7 shadow-sm sm:p-9">

                    <p class="text-xs font-black tracking-[0.2em] text-brand">
                        SOBRE ESTA EXPERIENCIA
                    </p>

                    <h2 class="mt-3 text-2xl font-black sm:text-3xl">
                        Conoce todos los detalles
                    </h2>

                    <p class="mt-5 whitespace-pre-line leading-8 text-muted">
                        {{ $tour->descripcion }}
                    </p>

                </section>

                {{-- DATOS DEL TOUR --}}
                <section class="rounded-3xl border border-stone-200 bg-white p-7 shadow-sm sm:p-9">

                    <h2 class="text-2xl font-black">
                        Información del tour
                    </h2>

                    <div class="mt-7 grid gap-6 sm:grid-cols-2">

                        <div class="rounded-2xl bg-surface p-5">
                            <p class="text-sm font-semibold text-muted">Fecha de salida</p>
                            <p class="mt-2 font-black text-ink">
                                {{ $tour->fecha_salida->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-surface p-5">
                            <p class="text-sm font-semibold text-muted">Duración</p>
                            <p class="mt-2 font-black text-ink">
                                {{ $tour->duracion_horas }} horas
                            </p>
                        </div>

                        <div class="rounded-2xl bg-surface p-5">
                            <p class="text-sm font-semibold text-muted">Guía turístico</p>
                            <p class="mt-2 font-black text-ink">
                                {{ $tour->guia?->name ?? 'Por asignar' }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-surface p-5">
                            <p class="text-sm font-semibold text-muted">Cupos disponibles</p>
                            <p class="mt-2 font-black {{ $cuposDisponibles > 0 ? 'text-green-700' : 'text-brand' }}">
                                {{ $cuposDisponibles }} personas
                            </p>
                        </div>

                    </div>

                </section>

                {{-- SERVICIOS --}}
                <section class="rounded-3xl border border-stone-200 bg-white p-7 shadow-sm sm:p-9">

                    <h2 class="text-2xl font-black">
                        Servicios incluidos
                    </h2>

                    <p class="mt-2 text-sm text-muted">
                        Estos son los servicios asociados a esta experiencia.
                    </p>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">

                        @forelse ($tour->servicios as $servicio)

                            <div class="flex items-center gap-3 rounded-xl bg-surface p-4">
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-light font-black text-brand">
                                    ✓
                                </span>

                                <span class="font-semibold text-ink">
                                    {{ $servicio->nombre }}
                                </span>
                            </div>

                        @empty

                            <p class="text-muted">
                                No hay servicios registrados para este tour.
                            </p>

                        @endforelse

                    </div>

                </section>

            </div>

            {{-- RESERVACIÓN --}}
            <aside class="lg:col-span-1">

                <div class="sticky top-28 rounded-3xl border border-stone-200 bg-white p-7 shadow-lg">

                    <p class="text-sm font-semibold text-muted">
                        Precio por persona
                    </p>

                    <p class="mt-2 text-4xl font-black text-brand">
                        Bs. {{ number_format((float) $tour->precio, 2) }}
                    </p>

                    <div class="my-6 border-t border-stone-200"></div>

                    <h2 class="text-xl font-black">
                        Reserva tu experiencia
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-muted">
                        Asegura tu lugar y prepárate para descubrir Potosí.
                    </p>

                    <div class="mt-5 rounded-xl bg-surface p-4">
                        <p class="text-sm text-muted">
                            Disponibilidad actual
                        </p>

                        <p class="mt-1 font-black {{ $cuposDisponibles > 0 ? 'text-green-700' : 'text-brand' }}">
                            {{ $cuposDisponibles > 0 ? $cuposDisponibles.' cupos disponibles' : 'Sin cupos disponibles' }}
                        </p>
                    </div>

                    @if ($cuposDisponibles <= 0)

                        <div class="mt-6 rounded-xl bg-red-50 p-4 text-center text-sm font-bold text-red-700">
                            Lo sentimos, este tour ya no tiene cupos disponibles.
                        </div>

                    @elseif (!auth()->check())

                        <a href="{{ route('login') }}"
                           class="mt-6 block rounded-xl bg-brand px-5 py-4 text-center font-bold text-white transition hover:bg-brand-dark">
                            Inicia sesión para reservar
                        </a>

                        <p class="mt-4 text-center text-sm text-muted">
                            ¿Todavía no tienes cuenta?
                            <a href="{{ route('register') }}" class="font-bold text-brand hover:underline">
                                Regístrate aquí
                            </a>
                        </p>

                    @elseif (auth()->user()->hasRole('turista'))

                        <form action="{{ route('reservas.store', $tour) }}"
                              method="POST"
                              class="mt-6 space-y-5">

                            @csrf

                            <div>
                                <label for="cantidad_personas"
                                       class="mb-2 block text-sm font-bold text-ink">
                                    Cantidad de personas
                                </label>

                                <input
                                    type="number"
                                    name="cantidad_personas"
                                    id="cantidad_personas"
                                    min="1"
                                    max="{{ $cuposDisponibles }}"
                                    value="{{ old('cantidad_personas', 1) }}"
                                    required
                                    class="w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                                >

                                @error('cantidad_personas')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="observacion"
                                       class="mb-2 block text-sm font-bold text-ink">
                                    Observaciones
                                    <span class="font-normal text-muted">(opcional)</span>
                                </label>

                                <textarea
                                    name="observacion"
                                    id="observacion"
                                    rows="4"
                                    placeholder="¿Tienes alguna solicitud especial?"
                                    class="w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                                >{{ old('observacion') }}</textarea>

                                @error('observacion')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            @error('tour')
                                <p class="rounded-xl bg-red-50 p-3 text-sm font-semibold text-red-700">
                                    {{ $message }}
                                </p>
                            @enderror

                            <button
                                type="submit"
                                class="w-full rounded-xl bg-brand px-6 py-4 font-black text-white shadow-md transition hover:bg-brand-dark">
                                Confirmar reserva →
                            </button>

                            <p class="text-center text-xs leading-5 text-muted">
                                Tu solicitud quedará registrada para su gestión.
                            </p>

                        </form>

                    @else

                        <div class="mt-6 rounded-xl bg-surface p-4 text-center text-sm text-muted">
                            Las reservas están disponibles únicamente para usuarios con rol de turista.
                        </div>

                    @endif

                </div>

            </aside>

        </div>

    </main>

    {{-- PIE DE PÁGINA --}}
    <footer class="mt-12 bg-ink py-10 text-white">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-5 px-5 sm:flex-row sm:items-center lg:px-8">

            <div>
                <p class="text-xl font-black">
                    Turi<span class="text-red-400">Potosí</span>
                </p>

                <p class="mt-2 text-sm text-stone-400">
                    Descubre · Viaja · Vive
                </p>
            </div>

            <p class="text-sm text-stone-400">
                © {{ date('Y') }} TuriPotosí. Todos los derechos reservados.
            </p>

        </div>
    </footer>

</body>
</html>
