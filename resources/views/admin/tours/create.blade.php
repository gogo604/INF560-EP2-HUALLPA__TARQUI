
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar tour | TuriPotosí</title>
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
                   class="rounded-full bg-brand-light px-4 py-2 text-brand">
                    Tours
                </a>

                <a href="{{ route('admin.reservas.index') }}"
                   class="rounded-full px-4 py-2 text-muted hover:bg-brand-light hover:text-brand">
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

    <main class="mx-auto max-w-5xl px-5 py-10 lg:px-8">

        <!-- TÍTULO -->
        <div class="mb-8">
            <a href="{{ route('admin.tours.index') }}"
               class="text-sm font-bold text-brand hover:text-brand-dark">
                ← Volver a los tours
            </a>

            <p class="mt-7 text-xs font-black tracking-[0.2em] text-brand">
                GESTIÓN DE EXPERIENCIAS
            </p>

            <h1 class="mt-2 text-3xl font-black text-ink sm:text-4xl">
                Registrar nuevo tour
            </h1>

            <p class="mt-3 text-muted">
                Completa los datos para publicar una nueva experiencia turística.
            </p>
        </div>

        <!-- FORMULARIO -->
        <section class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">

            <div class="border-b border-stone-100 bg-stone-50 px-6 py-5 sm:px-8">
                <h2 class="text-lg font-black text-ink">
                    Información del tour
                </h2>
                <p class="mt-1 text-sm text-muted">
                    Los campos marcados son obligatorios.
                </p>
            </div>

            <div class="p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-7 rounded-xl border border-red-200 bg-red-50 p-5 text-sm text-red-800">
                        <p class="font-bold">Corrige los siguientes errores:</p>
                        <ul class="mt-2 list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.tours.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <!-- DATOS GENERALES -->
                    <div class="mb-8">
                        <h3 class="mb-5 border-b border-stone-100 pb-3 text-sm font-black uppercase tracking-wider text-brand">
                            01. Datos generales
                        </h3>

                        <div class="grid gap-6 md:grid-cols-2">

                            <div class="md:col-span-2">
                                <label for="titulo" class="mb-2 block text-sm font-bold text-ink">
                                    Título del tour *
                                </label>
                                <input
                                    id="titulo"
                                    type="text"
                                    name="titulo"
                                    value="{{ old('titulo') }}"
                                    placeholder="Ej. Recorrido por el Cerro Rico"
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                    required
                                >
                            </div>

                            <div>
                                <label for="categoria_id" class="mb-2 block text-sm font-bold text-ink">
                                    Categoría *
                                </label>
                                <select
                                    id="categoria_id"
                                    name="categoria_id"
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                    required
                                >
                                    <option value="">Seleccionar categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            @selected(old('categoria_id') == $categoria->id)>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="guia_id" class="mb-2 block text-sm font-bold text-ink">
                                    Guía responsable
                                </label>
                                <select
                                    id="guia_id"
                                    name="guia_id"
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                >
                                    <option value="">Sin asignar</option>
                                    @foreach ($guias as $guia)
                                        <option value="{{ $guia->id }}"
                                            @selected(old('guia_id') == $guia->id)>
                                            {{ $guia->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="descripcion" class="mb-2 block text-sm font-bold text-ink">
                                    Descripción *
                                </label>
                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    rows="5"
                                    placeholder="Describe la experiencia turística, los lugares que se visitarán y qué hace especial este tour..."
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                    required
                                >{{ old('descripcion') }}</textarea>
                            </div>

                        </div>
                    </div>

                    <!-- DETALLES -->
                    <div class="mb-8">
                        <h3 class="mb-5 border-b border-stone-100 pb-3 text-sm font-black uppercase tracking-wider text-brand">
                            02. Precio y disponibilidad
                        </h3>

                        <div class="grid gap-6 sm:grid-cols-2">

                            <div>
                                <label for="precio" class="mb-2 block text-sm font-bold text-ink">
                                    Precio por persona (Bs.) *
                                </label>
                                <input
                                    id="precio"
                                    type="number"
                                    name="precio"
                                    value="{{ old('precio') }}"
                                    min="0.01"
                                    step="0.01"
                                    placeholder="150.00"
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                    required
                                >
                            </div>

                            <div>
                                <label for="duracion_horas" class="mb-2 block text-sm font-bold text-ink">
                                    Duración (horas) *
                                </label>
                                <input
                                    id="duracion_horas"
                                    type="number"
                                    name="duracion_horas"
                                    value="{{ old('duracion_horas') }}"
                                    min="1"
                                    placeholder="4"
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                    required
                                >
                            </div>

                            <div>
                                <label for="cupo_maximo" class="mb-2 block text-sm font-bold text-ink">
                                    Cupo máximo *
                                </label>
                                <input
                                    id="cupo_maximo"
                                    type="number"
                                    name="cupo_maximo"
                                    value="{{ old('cupo_maximo') }}"
                                    min="1"
                                    placeholder="20"
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                    required
                                >
                            </div>

                            <div>
                                <label for="fecha_salida" class="mb-2 block text-sm font-bold text-ink">
                                    Fecha y hora de salida *
                                </label>
                                <input
                                    id="fecha_salida"
                                    type="datetime-local"
                                    name="fecha_salida"
                                    value="{{ old('fecha_salida') }}"
                                    class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand"
                                    required
                                >
                            </div>

                        </div>
                    </div>

                    <!-- IMAGEN -->
                    <div class="mb-8">
                        <h3 class="mb-5 border-b border-stone-100 pb-3 text-sm font-black uppercase tracking-wider text-brand">
                            03. Imagen del tour
                        </h3>

                        <label for="imagen" class="mb-2 block text-sm font-bold text-ink">
                            Fotografía representativa
                        </label>

                        <input
                            id="imagen"
                            type="file"
                            name="imagen"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="w-full rounded-xl border border-stone-300 p-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-brand-light file:px-4 file:py-2 file:font-bold file:text-brand"
                        >

                        <p class="mt-2 text-xs text-muted">
                            Formatos permitidos: JPG, JPEG, PNG y WEBP.
                        </p>
                    </div>

                    <!-- SERVICIOS -->
                    <div class="mb-8">
                        <h3 class="mb-2 border-b border-stone-100 pb-3 text-sm font-black uppercase tracking-wider text-brand">
                            04. Servicios incluidos
                        </h3>

                        <p class="mb-5 text-sm text-muted">
                            Selecciona los servicios que estarán disponibles durante el tour.
                        </p>

                        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">

                            @foreach ($servicios as $servicio)
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-stone-200 p-4 transition hover:border-brand hover:bg-brand-light">
                                    <input
                                        type="checkbox"
                                        name="servicios[]"
                                        value="{{ $servicio->id }}"
                                        @checked(in_array($servicio->id, old('servicios', [])))
                                        class="rounded border-stone-300 text-brand focus:ring-brand"
                                    >
                                    <span class="text-sm font-semibold text-ink">
                                        {{ $servicio->nombre }}
                                    </span>
                                </label>
                            @endforeach

                        </div>
                    </div>

                    <!-- ESTADO -->
                    <div class="mb-8">
                        <h3 class="mb-5 border-b border-stone-100 pb-3 text-sm font-black uppercase tracking-wider text-brand">
                            05. Publicación
                        </h3>

                        <label for="activo" class="mb-2 block text-sm font-bold text-ink">
                            Estado del tour
                        </label>

                        <select
                            id="activo"
                            name="activo"
                            class="w-full rounded-xl border border-stone-300 p-3 focus:border-brand focus:ring-brand sm:max-w-xs"
                        >
                            <option value="1" @selected(old('activo', '1') == '1')>
                                Activo
                            </option>
                            <option value="0" @selected(old('activo') == '0')>
                                Inactivo
                            </option>
                        </select>

                        <p class="mt-2 text-xs text-muted">
                            Los tours activos pueden mostrarse en el catálogo público cuando cumplen las condiciones de fecha.
                        </p>
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col-reverse gap-3 border-t border-stone-100 pt-7 sm:flex-row sm:justify-end">

                        <a href="{{ route('admin.tours.index') }}"
                           class="rounded-xl border border-stone-300 px-7 py-3 text-center font-bold text-muted transition hover:bg-stone-100">
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-brand px-8 py-3 font-bold text-white shadow-lg transition hover:bg-brand-dark"
                        >
                            Guardar tour
                        </button>

                    </div>

                </form>
            </div>
        </section>

    </main>

    <footer class="mt-12 bg-ink py-8 text-center text-sm text-stone-400">
        © {{ date('Y') }} TuriPotosí · Administración de tours
    </footer>

</body>
</html>

