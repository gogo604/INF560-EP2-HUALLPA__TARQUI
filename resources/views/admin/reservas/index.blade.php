
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar reservas | TuriPotosí</title>
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
                    PANEL DE ADMINISTRACIÓN
                </span>
            </a>

            <nav class="flex flex-wrap items-center justify-end gap-2 text-sm font-bold">
                <a href="{{ route('dashboard') }}"
                   class="rounded-full px-4 py-2 text-muted hover:bg-brand-light hover:text-brand">
                    Mi panel
                </a>

                <a href="{{ route('admin.tours.index') }}"
                   class="rounded-full px-4 py-2 text-muted hover:bg-brand-light hover:text-brand">
                    Tours
                </a>

                <a href="{{ route('admin.reservas.index') }}"
                   class="rounded-full bg-brand-light px-4 py-2 text-brand">
                    Reservas
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

        <!-- TÍTULO -->
        <div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

            <div>
                <p class="text-xs font-black tracking-[0.2em] text-brand">
                    GESTIÓN DE RESERVAS
                </p>

                <h1 class="mt-2 text-3xl font-black text-ink sm:text-4xl">
                    Administración de reservas
                </h1>

                <p class="mt-3 text-muted">
                    Consulta las solicitudes y administra las reservas de los turistas.
                </p>
            </div>

            <a href="{{ route('admin.tours.index') }}"
               class="inline-flex items-center justify-center rounded-xl bg-brand px-6 py-3 font-bold text-white shadow-lg transition hover:bg-brand-dark">
                Administrar tours →
            </a>

        </div>

        <!-- MENSAJES -->
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-800">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5 text-sm text-red-800">
                <p class="font-bold">No se pudo actualizar la reserva:</p>

                <ul class="mt-2 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- TABLA DE RESERVAS -->
        <section class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">

            <div class="flex flex-col justify-between gap-2 border-b border-stone-100 bg-stone-50 px-6 py-5 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-lg font-black text-ink">
                        Reservas registradas
                    </h2>
                    <p class="mt-1 text-sm text-muted">
                        Administra el estado de cada solicitud.
                    </p>
                </div>

                <span class="w-fit rounded-full bg-brand-light px-4 py-2 text-sm font-bold text-brand">
                    {{ $reservas->total() }} reservas
                </span>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1100px] text-left">

                    <thead class="bg-ink text-xs uppercase tracking-wider text-white">
                        <tr>
                            <th class="px-5 py-4">Turista</th>
                            <th class="px-5 py-4">Tour</th>
                            <th class="px-5 py-4">Personas</th>
                            <th class="px-5 py-4">Fecha</th>
                            <th class="px-5 py-4">Estado actual</th>
                            <th class="px-5 py-4">Observación</th>
                            <th class="px-5 py-4">Actualizar estado</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-stone-100">

                        @forelse ($reservas as $reserva)

                            <tr class="transition hover:bg-[#fffaf9]">

                                <!-- TURISTA -->
                                <td class="px-5 py-5">
                                    <p class="font-bold text-ink">
                                        {{ $reserva->user->name }}
                                    </p>

                                    <p class="mt-1 text-xs text-muted">
                                        {{ $reserva->user->email }}
                                    </p>
                                </td>

                                <!-- TOUR -->
                                <td class="px-5 py-5">
                                    <p class="max-w-[200px] font-semibold text-ink">
                                        {{ $reserva->tour->titulo }}
                                    </p>
                                </td>

                                <!-- PERSONAS -->
                                <td class="px-5 py-5">
                                    <span class="inline-flex rounded-lg bg-stone-100 px-3 py-2 text-sm font-bold text-ink">
                                        {{ $reserva->cantidad_personas }}
                                    </span>
                                </td>

                                <!-- FECHA -->
                                <td class="whitespace-nowrap px-5 py-5">
                                    <p class="text-sm font-semibold text-ink">
                                        {{ $reserva->created_at->format('d/m/Y') }}
                                    </p>
                                    <p class="mt-1 text-xs text-muted">
                                        {{ $reserva->created_at->format('H:i') }}
                                    </p>
                                </td>

                                <!-- ESTADO -->
                                <td class="px-5 py-5">
                                    @if ($reserva->estado === 'pendiente')
                                        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-800">
                                            Pendiente
                                        </span>
                                    @elseif ($reserva->estado === 'confirmada')
                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1.5 text-xs font-bold text-green-800">
                                            Confirmada
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1.5 text-xs font-bold text-red-800">
                                            Cancelada
                                        </span>
                                    @endif
                                </td>

                                <!-- OBSERVACIÓN -->
                                <td class="px-5 py-5">
                                    <p class="max-w-[180px] text-sm text-muted">
                                        {{ $reserva->observacion ?: 'Sin observaciones' }}
                                    </p>
                                </td>

                                <!-- ACTUALIZAR ESTADO -->
                                <td class="px-5 py-5">

                                    <form action="{{ route('admin.reservas.estado', $reserva) }}"
                                          method="POST"
                                          class="flex min-w-[250px] items-center gap-2">

                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="estado"
                                            class="min-w-0 flex-1 rounded-lg border border-stone-300 bg-white px-3 py-2 text-sm focus:border-brand focus:ring-brand"
                                            required
                                        >
                                            <option value="pendiente"
                                                @selected($reserva->estado === 'pendiente')>
                                                Pendiente
                                            </option>

                                            <option value="confirmada"
                                                @selected($reserva->estado === 'confirmada')>
                                                Confirmada
                                            </option>

                                            <option value="cancelada"
                                                @selected($reserva->estado === 'cancelada')>
                                                Cancelada
                                            </option>
                                        </select>

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-brand px-4 py-2 text-xs font-bold text-white transition hover:bg-brand-dark"
                                        >
                                            Guardar
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-brand-light text-3xl">
                                        📋
                                    </div>

                                    <h3 class="mt-4 font-bold text-ink">
                                        No hay reservas registradas
                                    </h3>

                                    <p class="mt-2 text-sm text-muted">
                                        Cuando los turistas realicen reservas, aparecerán aquí.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINACIÓN -->
            @if ($reservas->hasPages())
                <div class="border-t border-stone-100 px-6 py-5">
                    {{ $reservas->links() }}
                </div>
            @endif

        </section>

    </main>

    <footer class="mt-12 bg-ink py-8 text-center text-sm text-stone-400">
        © {{ date('Y') }} TuriPotosí · Administración de reservas
    </footer>

</body>
</html>
