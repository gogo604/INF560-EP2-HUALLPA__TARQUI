
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#B5121B">
    <meta name="description" content="Descubre Potosí, Bolivia. Explora su historia, cultura, paisajes y experiencias turísticas.">

    <title>TuriPotosí | Descubre, viaja, vive</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">

    <!-- NAVEGACIÓN -->
    <header class="sticky top-0 z-50 border-b border-stone-200 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">

            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand text-2xl font-black text-white">
                    T
                </span>

                <span>
                    <span class="block text-2xl font-black tracking-tight">
                        Turi<span class="text-brand">Potosí</span>
                    </span>
                    <span class="block text-xs tracking-wider text-muted">
                        DESCUBRE · VIAJA · VIVE
                    </span>
                </span>
            </a>

            <nav class="hidden items-center gap-7 text-sm font-semibold text-stone-700 md:flex">
                <a href="{{ route('home') }}" class="text-brand">Inicio</a>
                <a href="{{ route('tours.index') }}" class="transition hover:text-brand">Tours</a>
                <a href="#nosotros" class="transition hover:text-brand">Nosotros</a>
                <a href="#contacto" class="transition hover:text-brand">Contacto</a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="rounded-full bg-brand px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-dark">
                        Mi cuenta
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden rounded-full border border-brand px-5 py-3 text-sm font-bold text-brand transition hover:bg-brand-light sm:inline-flex">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-full bg-brand px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-dark">
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main>

        <!-- PORTADA PRINCIPAL -->
        <section class="relative isolate flex min-h-[580px] items-center overflow-hidden bg-stone-900 sm:min-h-[650px]">

            <img
                src="{{ asset('images/potosi-hero.jpg') }}"
                alt="Vista panorámica de Potosí"
                class="absolute inset-0 -z-20 h-full w-full object-cover"
            >

            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-black/85 via-black/55 to-black/10"></div>

            <div class="mx-auto w-full max-w-7xl px-6 py-24 lg:px-8">
                <div class="max-w-3xl text-white">

                    <span class="inline-flex rounded-full border border-white/30 bg-white/10 px-5 py-2 text-xs font-bold tracking-[0.2em] text-white backdrop-blur">
                        POTOSÍ · BOLIVIA
                    </span>

                    <h1 class="mt-7 text-5xl font-black leading-tight tracking-tight sm:text-7xl">
                        Descubre la magia de
                        <span class="text-red-400">Potosí</span>
                    </h1>

                    <p class="mt-6 max-w-2xl text-lg leading-relaxed text-white/85 sm:text-xl">
                        Historia, cultura, naturaleza y aventura.
                        Vive experiencias inolvidables en uno de los destinos
                        más fascinantes de Bolivia.
                    </p>

                    <div class="mt-9 flex flex-wrap gap-4">

                        <a href="{{ route('tours.index') }}"
                           class="rounded-full bg-brand px-8 py-4 font-bold text-white shadow-lg transition hover:-translate-y-1 hover:bg-brand-dark">
                            Explorar tours →
                        </a>

                        <a href="#destinos"
                           class="rounded-full border border-white/70 bg-white/10 px-8 py-4 font-bold text-white backdrop-blur transition hover:bg-white hover:text-ink">
                            Conocer destinos
                        </a>

                    </div>

                    <div class="mt-12 flex flex-wrap gap-8 text-sm text-white/85">
                        <div>
                            <span class="block text-2xl font-black text-white">Historia</span>
                            <span>Patrimonio cultural</span>
                        </div>

                        <div>
                            <span class="block text-2xl font-black text-white">Naturaleza</span>
                            <span>Paisajes únicos</span>
                        </div>

                        <div>
                            <span class="block text-2xl font-black text-white">Aventura</span>
                            <span>Nuevas experiencias</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- DESTINOS DESTACADOS -->

{{-- TOURS DESTACADOS --}}
<section id="tours-destacados" class="bg-white py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <div class="mb-10 text-center">
            <p class="text-xs font-black tracking-[0.2em] text-brand">
                VIVE LA EXPERIENCIA
            </p>

            <h2 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">
                Nuestros tours destacados
            </h2>

            <p class="mx-auto mt-3 max-w-2xl text-muted">
                Descubre experiencias únicas y conoce Potosí
                acompañado de nuestros guías.
            </p>
        </div>

        @if ($toursDestacados->isNotEmpty())

            <div class="grid gap-7 md:grid-cols-2 xl:grid-cols-3">

                @foreach ($toursDestacados as $tour)

                    <article class="group overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                        <div class="h-56 overflow-hidden bg-stone-200">
                            <img
                                src="{{ $tour->imagen ? asset('storage/'.$tour->imagen) : asset('images/potosi-hero.jpg') }}"
                                alt="{{ $tour->titulo }}"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            >
                        </div>

                        <div class="p-6">

                            <p class="text-xs font-black uppercase tracking-wider text-brand">
                                {{ $tour->categoria?->nombre ?? 'Experiencia turística' }}
                            </p>

                            <h3 class="mt-2 text-xl font-black">
                                {{ $tour->titulo }}
                            </h3>

                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-muted">
                                {{ $tour->descripcion }}
                            </p>

                            <div class="mt-5 flex flex-wrap gap-4 text-sm text-muted">
                                <span>
                                    <strong>Duración:</strong>
                                    {{ $tour->duracion_horas }} horas
                                </span>

                                <span>
                                    <strong>Salida:</strong>
                                    {{ $tour->fecha_salida->format('d/m/Y') }}
                                </span>
                            </div>

                            <div class="mt-6 flex items-center justify-between border-t border-stone-100 pt-5">

                                <div>
                                    <p class="text-xs text-muted">Precio por persona</p>
                                    <p class="text-2xl font-black text-brand">
                                        Bs. {{ number_format((float) $tour->precio, 2) }}
                                    </p>
                                </div>

                                <a href="{{ route('tours.show', $tour->slug) }}"
                                   class="rounded-xl bg-brand px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-dark">
                                    Ver tour →
                                </a>

                            </div>

                        </div>
                    </article>

                @endforeach

            </div>

        @else

            <p class="rounded-2xl bg-surface p-8 text-center text-muted">
                Próximamente tendremos nuevas experiencias turísticas disponibles.
            </p>

        @endif

        <div class="mt-10 text-center">
            <a href="{{ route('tours.index') }}"
               class="inline-block rounded-xl border-2 border-brand px-7 py-3 font-bold text-brand transition hover:bg-brand hover:text-white">
                Ver todos los tours
            </a>
        </div>

    </div>
</section>


        <!-- SECCIÓN SOBRE POTOSÍ -->
        <section id="nosotros" class="bg-white">
            <div class="mx-auto grid max-w-7xl gap-12 px-5 py-20 md:grid-cols-2 md:items-center lg:px-8">

                <div>
                    <p class="text-xs font-black tracking-[0.2em] text-brand">
                        NUESTRA TIERRA
                    </p>

                    <h2 class="mt-4 text-3xl font-black leading-tight sm:text-4xl">
                        Una experiencia que comienza en Potosí
                    </h2>

                    <p class="mt-6 leading-relaxed text-muted">
                        TuriPotosí es una plataforma para descubrir experiencias
                        turísticas, conocer lugares extraordinarios y reservar
                        tours acompañados por guías locales.
                    </p>

                    <p class="mt-4 leading-relaxed text-muted">
                        Queremos acercarte a la riqueza histórica, cultural
                        y natural de nuestro departamento.
                    </p>

                    <a href="{{ route('tours.index') }}"
                       class="mt-8 inline-flex rounded-full bg-brand px-7 py-4 font-bold text-white transition hover:bg-brand-dark">
                        Descubrir experiencias →
                    </a>
                </div>

                <div class="overflow-hidden rounded-3xl shadow-xl">
                    <img
                        src="{{ asset('images/casa-moneda.jpg') }}"
                        alt="Patrimonio histórico de Potosí"
                        class="h-80 w-full object-cover md:h-[420px]"
                    >
                </div>

            </div>
        </section>

        <!-- INVITACIÓN -->
        <section class="bg-brand">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-7 px-6 py-16 text-center text-white md:flex-row md:text-left lg:px-8">

                <div>
                    <h2 class="text-3xl font-black">
                        Tu próxima aventura comienza aquí
                    </h2>

                    <p class="mt-3 text-white/85">
                        Explora nuestros tours y descubre todo lo que Potosí tiene para ofrecer.
                    </p>
                </div>

                <a href="{{ route('tours.index') }}"
                   class="shrink-0 rounded-full bg-white px-8 py-4 font-bold text-brand transition hover:bg-brand-light">
                    Ver todos los tours →
                </a>

            </div>
        </section>

    </main>

    <!-- PIE DE PÁGINA -->
    <footer id="contacto" class="bg-stone-950 text-white">

        <div class="mx-auto grid max-w-7xl gap-10 px-6 py-14 sm:grid-cols-2 lg:grid-cols-3 lg:px-8">

            <div>
                <h2 class="text-3xl font-black">
                    Turi<span class="text-red-400">Potosí</span>
                </h2>

                <p class="mt-3 text-sm text-stone-400">
                    Descubre · Viaja · Vive
                </p>

                <p class="mt-5 max-w-xs text-sm leading-relaxed text-stone-400">
                    Conectamos visitantes con experiencias turísticas
                    en Potosí, Bolivia.
                </p>
            </div>

            <div>
                <h3 class="font-bold">Navegación</h3>

                <div class="mt-5 flex flex-col gap-3 text-sm text-stone-400">
                    <a href="{{ route('home') }}" class="hover:text-white">Inicio</a>
                    <a href="{{ route('tours.index') }}" class="hover:text-white">Destinos y tours</a>
                    <a href="#nosotros" class="hover:text-white">Sobre nosotros</a>
                    <a href="#contacto" class="hover:text-white">Contacto</a>
                </div>
            </div>

            <div>
                <h3 class="font-bold">Tu cuenta</h3>

                <div class="mt-5 flex flex-col gap-3 text-sm text-stone-400">
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-white">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="hover:text-white">Crear cuenta</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="hover:text-white">Mi cuenta</a>
                    @endguest

                    <a href="{{ route('tours.index') }}" class="hover:text-white">Explorar tours</a>
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 px-5 py-5 text-center text-xs text-stone-500">
            © {{ date('Y') }} TuriPotosí. Todos los derechos reservados.
        </div>

    </footer>

</body>
</html>
