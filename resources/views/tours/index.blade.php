<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar tours | TuriPotosí</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-surface">

    {{-- ENCABEZADO --}}
    <header class="sticky top-0 z-40 border-b border-stone-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand text-xl font-black text-white">
                    TP
                </div>

                <div>
                    <h1 class="text-xl font-black tracking-tight text-ink">
                        Turi<span class="text-brand">Potosí</span>
                    </h1>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-muted">
                        Descubre Potosí
                    </p>
                </div>
            </a>

            <nav class="hidden items-center gap-7 text-sm font-semibold text-stone-600 md:flex">
                <a href="{{ route('home') }}" class="transition hover:text-brand">
                    Inicio
                </a>

                <a href="{{ route('tours.index') }}" class="text-brand">
                    Explorar tours
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="transition hover:text-brand">
                        Mi panel
                    </a>

                    @if(auth()->user()->hasRole('turista'))
                        <a href="{{ route('reservas.mias') }}" class="transition hover:text-brand">
                            Mis reservas
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.tours.index') }}" class="transition hover:text-brand">
                            Administración
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('guia'))
                        <a href="{{ route('guia.tours') }}" class="transition hover:text-brand">
                            Mis tours
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="transition hover:text-brand">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-xl bg-brand px-5 py-3 font-bold text-white transition hover:bg-brand-dark">
                        Registrarme
                    </a>
                @endauth
            </nav>

            <div class="md:hidden">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="rounded-lg bg-brand px-4 py-2 text-sm font-bold text-white">
                        Mi panel
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg bg-brand px-4 py-2 text-sm font-bold text-white">
                        Ingresar
                    </a>
                @endauth
            </div>

        </div>
    </header>


    {{-- HERO --}}
    <section class="relative overflow-hidden bg-ink">
        <div class="absolute inset-0">
            <img
                src="{{ asset('images/potosi-hero.jpg') }}"
                alt="Paisaje turístico de Potosí"
                class="h-full w-full object-cover opacity-30"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-ink via-ink/85 to-ink/40"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-6 py-20 md:py-28">
            <div class="max-w-3xl">

                <span class="inline-flex rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-white">
                    Vive una experiencia inolvidable
                </span>

                <h2 class="mt-6 text-4xl font-black leading-tight text-white md:text-6xl">
                    Explora los mejores
                    <span class="text-red-400">tours de Potosí</span>
                </h2>

                <p class="mt-6 max-w-2xl text-base leading-8 text-stone-300 md:text-lg">
                    Descubre la historia, cultura, naturaleza y aventura de Potosí.
                    Encuentra tu próxima experiencia y reserva de manera sencilla.
                </p>

                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="#catalogo"
                       class="rounded-xl bg-brand px-7 py-4 font-bold text-white shadow-lg transition hover:bg-brand-dark">
                        Explorar experiencias
                    </a>

                    <a href="{{ route('home') }}"
                       class="rounded-xl border border-white/30 px-7 py-4 font-bold text-white transition hover:bg-white/10">
                        Volver al inicio
                    </a>
                </div>

            </div>
        </div>
    </section>


    {{-- CATÁLOGO --}}
    <main id="catalogo" class="mx-auto max-w-7xl px-6 py-16">

        <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand">
                    Nuestras experiencias
                </p>

                <h2 class="mt-2 text-3xl font-black text-ink md:text-4xl">
                    Tours disponibles
                </h2>

                <p class="mt-3 text-muted">
                    Encuentra la experiencia ideal para descubrir Potosí.
                </p>
            </div>

            <div class="rounded-xl border border-stone-200 bg-white px-5 py-3">
                <p class="text-sm text-muted">
                    Experiencias encontradas
                </p>
                <p class="text-2xl font-black text-brand">
                    {{ $tours->total() }}
                </p>
            </div>
        </div>


        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-800">
                {{ session('error') }}
            </div>
        @endif


        {{-- TARJETAS DE TOURS --}}
        @if($tours->count())

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($tours as $tour)

                    <article class="group overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                        {{-- IMAGEN --}}
                        <div class="relative h-56 overflow-hidden bg-stone-200">

                            @if($tour->imagen)
                                <img
                                    src="{{ asset('storage/' . $tour->imagen) }}"
                                    alt="{{ $tour->titulo }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-full items-center justify-center bg-stone-100">
                                    <span class="text-sm font-semibold text-stone-400">
                                        Imagen no disponible
                                    </span>
                                </div>
                            @endif

                            <div class="absolute left-4 top-4">
                                <span class="rounded-full bg-white px-4 py-2 text-xs font-bold text-brand shadow">
                                    {{ $tour->categoria?->nombre ?? 'Turismo' }}
                                </span>
                            </div>

                            <div class="absolute right-4 top-4">
                                @if($tour->cuposDisponibles() > 0)
                                    <span class="rounded-full bg-green-600 px-3 py-2 text-xs font-bold text-white shadow">
                                        Disponible
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-600 px-3 py-2 text-xs font-bold text-white shadow">
                                        Agotado
                                    </span>
                                @endif
                            </div>

                        </div>


                        {{-- INFORMACIÓN --}}
                        <div class="p-6">

                            <div class="mb-3 flex items-center gap-2 text-xs font-semibold text-muted">
                                <span>
                                    {{ $tour->fecha_salida->format('d/m/Y H:i') }}
                                </span>

                                <span>•</span>

                                <span>
                                    {{ $tour->duracion_horas }} horas
                                </span>
                            </div>

                            <h3 class="text-xl font-black leading-snug text-ink">
                                {{ $tour->titulo }}
                            </h3>

                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-muted">
                                {{ $tour->descripcion }}
                            </p>


                            {{-- GUÍA --}}
                            @if($tour->guia)
                                <div class="mt-4 flex items-center gap-2 text-sm text-stone-600">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-light font-bold text-brand">
                                        {{ strtoupper(substr($tour->guia->name, 0, 1)) }}
                                    </span>

                                    <span>
                                        Guía: <strong>{{ $tour->guia->name }}</strong>
                                    </span>
                                </div>
                            @endif


                            {{-- SERVICIOS --}}
                            @if($tour->servicios->count())
                                <div class="mt-5 border-t border-stone-100 pt-4">

                                    <p class="mb-3 text-xs font-bold uppercase tracking-wider text-muted">
                                        Servicios incluidos
                                    </p>

                                    <div class="flex flex-wrap gap-2">
                                        @foreach($tour->servicios as $servicio)
                                            <span class="rounded-lg bg-stone-100 px-3 py-2 text-xs font-medium text-stone-600">
                                                {{ $servicio->nombre }}
                                            </span>
                                        @endforeach
                                    </div>

                                </div>
                            @endif


                            {{-- PRECIO Y CUPOS --}}
                            <div class="mt-6 flex items-end justify-between border-t border-stone-100 pt-5">

                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-muted">
                                        Precio por persona
                                    </p>

                                    <p class="mt-1 text-2xl font-black text-brand">
                                        Bs. {{ number_format($tour->precio, 2) }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p class="text-xs text-muted">
                                        Cupos disponibles
                                    </p>

                                    <p class="mt-1 font-bold text-ink">
                                        {{ $tour->cuposDisponibles() }}
                                    </p>
                                </div>

                            </div>


                            {{-- BOTÓN --}}
                            <a
                                href="{{ route('tours.show', $tour->slug) }}"
                                class="mt-6 flex w-full items-center justify-center rounded-xl bg-brand px-5 py-4 text-sm font-bold text-white transition hover:bg-brand-dark"
                            >
                                Ver detalles del tour
                                <span class="ml-2">→</span>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- PAGINACIÓN --}}
            <div class="mt-12">
                {{ $tours->links() }}
            </div>

        @else

            {{-- ESTADO VACÍO --}}
            <div class="rounded-2xl border border-stone-200 bg-white px-6 py-20 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-brand-light text-3xl">
                    🧭
                </div>

                <h3 class="mt-6 text-2xl font-black text-ink">
                    No hay tours disponibles
                </h3>

                <p class="mx-auto mt-3 max-w-md text-sm leading-7 text-muted">
                    Por el momento no tenemos experiencias disponibles.
                    Vuelve pronto para descubrir nuevas aventuras en Potosí.
                </p>

                <a href="{{ route('home') }}"
                   class="mt-7 inline-flex rounded-xl bg-brand px-6 py-3 font-bold text-white transition hover:bg-brand-dark">
                    Volver al inicio
                </a>

            </div>

        @endif

    </main>


    {{-- PIE DE PÁGINA --}}
    <footer class="bg-ink">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-5 px-6 py-10 md:flex-row md:items-center">

            <div>
                <h2 class="text-xl font-black text-white">
                    Turi<span class="text-red-400">Potosí</span>
                </h2>

                <p class="mt-2 text-sm text-stone-400">
                    Descubre Potosí, vive su historia y disfruta sus experiencias.
                </p>
            </div>

            <div class="text-sm text-stone-400">
                © {{ date('Y') }} TuriPotosí. Todos los derechos reservados.
            </div>

        </div>
    </footer>

</body>
</html>
