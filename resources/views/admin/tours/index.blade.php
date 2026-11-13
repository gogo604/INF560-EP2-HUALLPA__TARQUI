<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Tours | TuriPotosí</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fffaf9] text-zinc-900">
<header class="sticky top-0 z-40 border-b border-red-100 bg-white/95 shadow-sm backdrop-blur"><div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6"><a href="{{ route('home') }}" class="shrink-0 leading-tight"><span class="block text-xl font-black text-zinc-900">Turi<span class="text-red-700">Potosí</span></span><span class="block text-[10px] font-semibold tracking-wider text-zinc-500">DESCUBRE · VIAJA · VIVE</span></a><nav class="flex flex-wrap items-center justify-end gap-2 text-sm font-semibold"><a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('home') }}">Inicio</a>@auth<a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('dashboard') }}">Panel</a>@if(auth()->user()->hasRole('admin'))<a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('admin.tours.index') }}">Tours</a><a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('admin.reservas.index') }}">Reservas</a>@endif<a class="rounded-full px-3 py-2 text-zinc-600 hover:bg-red-50 hover:text-red-700" href="{{ route('profile.edit') }}">Mi perfil</a>@else<a class="rounded-full bg-red-700 px-4 py-2 text-white hover:bg-red-800" href="{{ route('login') }}">Iniciar sesión</a>@endauth</nav></div></header>


    <header class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <h1 class="text-xl font-bold">
                TuriPotosí | Administración
            </h1>

            <a href="{{ route('tours.index') }}"
               class="text-gray-300 hover:text-white">
                Ver catálogo público
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex flex-col sm:flex-row justify-between gap-4 mb-8">

            <div>
                <h2 class="text-3xl font-bold">
                    Gestión de tours
                </h2>

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded-xl mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <p class="text-zinc-500 mt-2">
                    Administra los tours registrados en el sistema.
                </p>
            </div>

            <a href="{{ route('admin.tours.create') }}"
               class="bg-red-700 hover:bg-amber-800 text-white px-5 py-3 rounded-xl font-semibold text-center">
                + Nuevo tour
            </a>

        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-[#fffaf9] border-b">
                    <tr>
                        <th class="px-5 py-4">Tour</th>
                        <th class="px-5 py-4">Categoría</th>
                        <th class="px-5 py-4">Guía</th>
                        <th class="px-5 py-4">Precio</th>
                        <th class="px-5 py-4">Estado</th>
                        <th class="px-5 py-4">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse ($tours as $tour)

                        <tr>
                            <td class="px-5 py-4 font-semibold">
                                {{ $tour->titulo }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $tour->categoria->nombre }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $tour->guia?->name ?? 'Sin asignar' }}
                            </td>

                            <td class="px-5 py-4">
                                Bs. {{ number_format((float) $tour->precio, 2) }}
                            </td>

                            <td class="px-5 py-4">
                                @if ($tour->activo)
                                    <span class="text-green-700 font-semibold">
                                        Activo
                                    </span>
                                @else
                                    <span class="text-red-700 font-semibold">
                                        Inactivo
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <a href="{{ route('admin.tours.edit', $tour) }}"
                                   class="text-red-800 hover:underline">
                                    Editar
                                </a>
                                <form action="{{ route('admin.tours.destroy', $tour) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este tour?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-semibold">
                                        Eliminar
                                    </button>

                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-10 text-zinc-500">
                                No hay tours registrados.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $tours->links() }}
        </div>

    </main>
</body>
</html>
