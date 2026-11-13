<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis reservas - TuriPotosí</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fffaf9] min-h-screen">
<header class="sticky top-0 z-40 border-b border-red-100 bg-white/95 shadow-sm backdrop-blur"><div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6"><a href="{{ route('home') }}" class="shrink-0 leading-tight"><span class="block text-xl font-black text-zinc-900">Turi<span class="text-red-700">Potosí</span></span><span class="block text-[10px] font-semibold tracking-wider text-zinc-500">DESCUBRE · VIAJA · VIVE</span></a><nav class="flex flex-wrap items-center justify-end gap-2 text-sm font-semibold"><a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('home') }}">Inicio</a>@auth<a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('dashboard') }}">Panel</a>@if(auth()->user()->hasRole('admin'))<a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('admin.tours.index') }}">Tours</a><a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('admin.reservas.index') }}">Reservas</a>@endif<a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('profile.edit') }}">Mi perfil</a>@else<a class="rounded-full bg-red-700 px-4 py-2 text-white hover:bg-red-800" href="{{ route('login') }}">Iniciar sesión</a>@endauth</nav></div></header>


    <header class="bg-indigo-700 text-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <h1 class="text-2xl font-bold">TuriPotosí</h1>

            <div class="flex items-center gap-5">

                <nav class="flex gap-4 text-sm">
                    <a href="{{ route('home') }}" class="hover:underline">Inicio</a>
                    <a href="{{ route('tours.index') }}" class="hover:underline">Tours</a>
                    <a href="{{ route('reservas.mias') }}" class="font-bold underline">Mis reservas</a>
                </nav>

                <div class="flex items-center gap-3 text-sm">
                    <span>{{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="bg-indigo-800 hover:bg-indigo-900 px-3 py-2 rounded-xl">
                            Cerrar sesión
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-zinc-900">Mis reservas</h2>
            <p class="text-zinc-600 mt-2">
                Hola, {{ auth()->user()->name }}. Aquí puedes consultar tus reservas.
            </p>
        </div>

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensaje de error general --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl mb-6">
                <p class="font-semibold mb-2">No se pudo completar la operación:</p>

                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($reservas->isEmpty())
            <div class="bg-white rounded-xl shadow p-10 text-center">
                <h3 class="text-xl font-semibold text-zinc-800">
                    Todavía no tienes reservas.
                </h3>

                <p class="text-zinc-500 mt-2">
                    Explora nuestros tours y reserva tu próxima aventura.
                </p>

                <a href="{{ route('tours.index') }}"
                   class="inline-block mt-5 bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700">
                    Explorar tours
                </a>
            </div>
        @else

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#fffaf9] text-zinc-800 uppercase">
                            <tr>
                                <th class="px-6 py-4">Tour</th>
                                <th class="px-6 py-4">Personas</th>
                                <th class="px-6 py-4">Precio por persona</th>
                                <th class="px-6 py-4">Fecha de salida</th>
                                <th class="px-6 py-4">Estado</th>
                                <th class="px-6 py-4">Observación</th>
                                <th class="px-6 py-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($reservas as $reserva)
                                <tr class="hover:bg-[#fffaf9]">

                                    <td class="px-6 py-4 font-semibold text-zinc-900">
                                        {{ $reserva->tour->titulo }}
                                        <p class="text-xs text-zinc-500 font-normal">
                                            {{ $reserva->tour->categoria->nombre }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $reserva->cantidad_personas }}
                                    </td>

                                    <td class="px-6 py-4">
                                        Bs. {{ number_format($reserva->tour->precio, 2) }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $reserva->tour->fecha_salida->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($reserva->estado === 'pendiente')
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">
                                                Pendiente
                                            </span>
                                        @elseif ($reserva->estado === 'confirmada')
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs">
                                                Confirmada
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">
                                                Cancelada
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-zinc-600">
                                        {{ $reserva->observacion ?? 'Sin observaciones' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if (in_array($reserva->estado, ['pendiente', 'confirmada']))
                                            <form action="{{ route('reservas.cancelar', $reserva) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Estás seguro de cancelar esta reserva?')">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 font-semibold">
                                                    Cancelar
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">Sin acciones</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $reservas->links() }}
            </div>

        @endif

        <div class="mt-8">
            <a href="{{ route('tours.index') }}"
               class="text-indigo-600 hover:underline">
                ← Volver al catálogo de tours
            </a>
        </div>

    </main>

</body>
</html>
