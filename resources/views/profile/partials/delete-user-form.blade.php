
<section class="space-y-6">

    <header>
        <h2 class="text-lg font-black text-red-700">
            Zona de eliminación de cuenta
        </h2>

        <p class="mt-2 text-sm leading-6 text-muted">
            Esta acción es permanente. Al eliminar tu cuenta, tus datos y recursos
            asociados serán eliminados. Asegúrate de guardar cualquier información
            que quieras conservar antes de continuar.
        </p>
    </header>

    <!-- BOTÓN PARA ABRIR LA CONFIRMACIÓN -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Eliminar mi cuenta
    </x-danger-button>

    <!-- VENTANA DE CONFIRMACIÓN -->
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">

            @csrf
            @method('delete')

            <div class="mb-5 flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                    <span class="text-2xl text-red-700">!</span>
                </div>

                <h2 class="text-lg font-black text-ink">
                    ¿Estás seguro de eliminar tu cuenta?
                </h2>
            </div>

            <p class="text-sm leading-6 text-muted">
                Esta acción no se puede deshacer. Se eliminarán permanentemente
                tu cuenta y los datos asociados. Para confirmar esta operación,
                introduce tu contraseña actual.
            </p>

            <!-- CONTRASEÑA -->
            <div class="mt-6">

                <x-input-label
                    for="password"
                    value="Contraseña actual"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-xl border-stone-300 focus:border-brand focus:ring-brand"
                    placeholder="Introduce tu contraseña"
                    autocomplete="current-password"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>

            <!-- ACCIONES -->
            <div class="mt-8 flex flex-wrap justify-end gap-3">

                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Confirmar eliminación
                </x-danger-button>

            </div>

        </form>

    </x-modal>

</section>
