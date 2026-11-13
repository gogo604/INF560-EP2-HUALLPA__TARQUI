
<section>

    <header>
        <h2 class="text-lg font-black text-ink">
            Información personal
        </h2>

        <p class="mt-1 text-sm text-muted">
            Actualiza tu nombre y dirección de correo electrónico.
        </p>
    </header>

    <!-- FORMULARIO DE VERIFICACIÓN -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- ACTUALIZAR INFORMACIÓN -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">

        @csrf
        @method('patch')

        <!-- NOMBRE -->
        <div>
            <x-input-label for="name" value="Nombre completo" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- CORREO -->
        <div>
            <x-input-label for="email" value="Correo electrónico" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- VERIFICACIÓN DEL CORREO -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4">

                    <p class="text-sm font-semibold text-amber-800">
                        Tu correo electrónico todavía no ha sido verificado.
                    </p>

                    <button
                        form="send-verification"
                        class="mt-2 text-sm font-bold text-brand underline hover:text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand"
                    >
                        Haz clic aquí para reenviar el correo de verificación.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 text-sm font-semibold text-green-700">
                            Se ha enviado un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif

                </div>

            @endif

        </div>

        <!-- BOTÓN Y CONFIRMACIÓN -->
        <div class="flex flex-wrap items-center gap-4 border-t border-stone-100 pt-5">

            <x-primary-button>
                Guardar cambios
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-semibold text-green-700"
                >
                    ✓ Información actualizada correctamente.
                </p>
            @endif

        </div>

    </form>

</section>
