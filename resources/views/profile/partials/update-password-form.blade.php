
<section>

    <header>
        <h2 class="text-lg font-black text-ink">
            Seguridad de la cuenta
        </h2>

        <p class="mt-1 text-sm text-muted">
            Cambia tu contraseña periódicamente para mantener protegida tu cuenta.
            Utiliza una contraseña segura y difícil de adivinar.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">

        @csrf
        @method('put')

        <!-- CONTRASEÑA ACTUAL -->
        <div>
            <x-input-label
                for="update_password_current_password"
                value="Contraseña actual"
            />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-2 block w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />
        </div>

        <!-- NUEVA CONTRASEÑA -->
        <div>
            <x-input-label
                for="update_password_password"
                value="Nueva contraseña"
            />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-2 block w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />
        </div>

        <!-- CONFIRMAR CONTRASEÑA -->
        <div>
            <x-input-label
                for="update_password_password_confirmation"
                value="Confirmar nueva contraseña"
            />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-2 block w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        <!-- BOTÓN Y CONFIRMACIÓN -->
        <div class="flex flex-wrap items-center gap-4 border-t border-stone-100 pt-5">

            <x-primary-button>
                Actualizar contraseña
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-semibold text-green-700"
                >
                    ✓ Contraseña actualizada correctamente.
                </p>
            @endif

        </div>

    </form>

</section>
