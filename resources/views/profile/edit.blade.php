
<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-black tracking-[0.2em] text-brand">
                CONFIGURACIÓN DE CUENTA
            </p>

            <h2 class="mt-2 text-2xl font-black text-ink">
                Mi perfil
            </h2>

            <p class="mt-1 text-sm text-muted">
                Administra tu información personal y la seguridad de tu cuenta.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-surface py-10">

        <div class="mx-auto max-w-5xl space-y-7 px-5 lg:px-8">

            <!-- PRESENTACIÓN -->
            <div class="rounded-3xl bg-ink p-7 text-white shadow-sm sm:p-9">
                <p class="text-xs font-bold tracking-[0.2em] text-red-300">
                    TURIPOTOSÍ
                </p>

                <h1 class="mt-3 text-2xl font-black sm:text-3xl">
                    Hola, {{ auth()->user()->name }}
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-relaxed text-stone-300">
                    Mantén tus datos actualizados para disfrutar de una mejor
                    experiencia en nuestra plataforma turística.
                </p>
            </div>

            <!-- INFORMACIÓN PERSONAL -->
            <section class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">

                <div class="border-b border-stone-100 bg-stone-50 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-black text-ink">
                        Información personal
                    </h3>

                    <p class="mt-1 text-sm text-muted">
                        Actualiza tu nombre y dirección de correo electrónico.
                    </p>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

            </section>

            <!-- SEGURIDAD -->
            <section class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">

                <div class="border-b border-stone-100 bg-stone-50 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-black text-ink">
                        Seguridad de la cuenta
                    </h3>

                    <p class="mt-1 text-sm text-muted">
                        Cambia tu contraseña para mantener protegida tu cuenta.
                    </p>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

            </section>

            <!-- ELIMINAR CUENTA -->
            <section class="overflow-hidden rounded-3xl border border-red-200 bg-white shadow-sm">

                <div class="border-b border-red-100 bg-red-50 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-black text-red-800">
                        Zona de eliminación de cuenta
                    </h3>

                    <p class="mt-1 text-sm text-red-700">
                        Esta acción es permanente. Lee cuidadosamente antes de continuar.
                    </p>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </section>

            <!-- VOLVER -->
            <div class="flex justify-end">
                <a href="{{ route('dashboard') }}"
                   class="rounded-xl border border-stone-300 bg-white px-6 py-3 text-sm font-bold text-muted transition hover:bg-stone-100">
                    ← Volver al panel
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
