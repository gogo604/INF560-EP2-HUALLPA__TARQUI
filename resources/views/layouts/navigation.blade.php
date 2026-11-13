
<nav x-data="{ open: false }" class="border-b border-red-100 bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="leading-tight">
                    <span class="block text-2xl font-black text-zinc-900">
                        Turi<span class="text-red-700">Potosí</span>
                    </span>
                    <span class="block text-[10px] font-semibold tracking-wider text-zinc-500">
                        DESCUBRE · VIAJA · VIVE
                    </span>
                </a>

                <!-- Navegación escritorio -->
                <div class="hidden items-center gap-2 md:flex">
                    <a href="{{ route('dashboard') }}"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition
                        {{ request()->routeIs('dashboard') ? 'bg-red-700 text-white' : 'text-zinc-600 hover:bg-red-50 hover:text-red-700' }}">
                        Panel
                    </a>

                    <a href="{{ route('tours.index') }}"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition
                        {{ request()->routeIs('tours.*') ? 'bg-red-700 text-white' : 'text-zinc-600 hover:bg-red-50 hover:text-red-700' }}">
                        Explorar tours
                    </a>

                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.tours.index') }}"
                            class="rounded-full px-4 py-2 text-sm font-semibold transition
                            {{ request()->routeIs('admin.tours.*') ? 'bg-red-700 text-white' : 'text-zinc-600 hover:bg-red-50 hover:text-red-700' }}">
                            Administrar tours
                        </a>

                        <a href="{{ route('admin.reservas.index') }}"
                            class="rounded-full px-4 py-2 text-sm font-semibold transition
                            {{ request()->routeIs('admin.reservas.*') ? 'bg-red-700 text-white' : 'text-zinc-600 hover:bg-red-50 hover:text-red-700' }}">
                            Reservas
                        </a>

                    @elseif(auth()->user()->hasRole('guia'))
                        <a href="{{ route('guia.tours') }}"
                            class="rounded-full px-4 py-2 text-sm font-semibold transition
                            {{ request()->routeIs('guia.*') ? 'bg-red-700 text-white' : 'text-zinc-600 hover:bg-red-50 hover:text-red-700' }}">
                            Mis tours
                        </a>

                    @elseif(auth()->user()->hasRole('turista'))
                        <a href="{{ route('reservas.mias') }}"
                            class="rounded-full px-4 py-2 text-sm font-semibold transition
                            {{ request()->routeIs('reservas.*') ? 'bg-red-700 text-white' : 'text-zinc-600 hover:bg-red-50 hover:text-red-700' }}">
                            Mis reservas
                        </a>
                    @endif
                </div>
            </div>

            <!-- Menú de usuario escritorio -->
            <div class="hidden items-center md:flex">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-full border border-zinc-200 px-3 py-2 text-sm font-semibold text-zinc-700 transition hover:border-red-200 hover:text-red-700">
                            <span class="grid h-9 w-9 place-items-center rounded-full bg-red-100 font-bold text-red-700">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>

                            <span>{{ auth()->user()->name }}</span>
                            <span class="text-zinc-400">⌄</span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Mi perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 text-start text-sm leading-5 text-zinc-700 transition hover:bg-red-50 hover:text-red-700 focus:bg-red-50 focus:text-red-700 focus:outline-none">
                                Cerrar sesión
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Botón menú móvil -->
            <div class="flex items-center md:hidden">
                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-zinc-500 transition hover:bg-red-50 hover:text-red-700"
                    aria-label="Abrir menú"
                    :aria-expanded="open.toString()"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div x-show="open" x-transition class="border-t border-zinc-100 bg-white pb-4 pt-3 md:hidden">
        <div class="space-y-1 px-4">
            <a href="{{ route('dashboard') }}"
                class="block rounded-lg px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-700' : 'text-zinc-700 hover:bg-red-50 hover:text-red-700' }}">
                Panel de control
            </a>

            <a href="{{ route('tours.index') }}"
                class="block rounded-lg px-4 py-3 text-sm font-semibold {{ request()->routeIs('tours.*') ? 'bg-red-50 text-red-700' : 'text-zinc-700 hover:bg-red-50 hover:text-red-700' }}">
                Explorar tours
            </a>

            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.tours.index') }}"
                    class="block rounded-lg px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.tours.*') ? 'bg-red-50 text-red-700' : 'text-zinc-700 hover:bg-red-50 hover:text-red-700' }}">
                    Administrar tours
                </a>

                <a href="{{ route('admin.reservas.index') }}"
                    class="block rounded-lg px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.reservas.*') ? 'bg-red-50 text-red-700' : 'text-zinc-700 hover:bg-red-50 hover:text-red-700' }}">
                    Reservas
                </a>

            @elseif(auth()->user()->hasRole('guia'))
                <a href="{{ route('guia.tours') }}"
                    class="block rounded-lg px-4 py-3 text-sm font-semibold {{ request()->routeIs('guia.*') ? 'bg-red-50 text-red-700' : 'text-zinc-700 hover:bg-red-50 hover:text-red-700' }}">
                    Mis tours asignados
                </a>

            @elseif(auth()->user()->hasRole('turista'))
                <a href="{{ route('reservas.mias') }}"
                    class="block rounded-lg px-4 py-3 text-sm font-semibold {{ request()->routeIs('reservas.*') ? 'bg-red-50 text-red-700' : 'text-zinc-700 hover:bg-red-50 hover:text-red-700' }}">
                    Mis reservas
                </a>
            @endif
        </div>

        <!-- Usuario móvil -->
        <div class="mt-4 border-t border-zinc-100 px-6 py-4">
            <p class="font-bold text-zinc-900">
                {{ auth()->user()->name }}
            </p>
            <p class="mt-1 text-sm text-zinc-500">
                {{ auth()->user()->email }}
            </p>

            <a href="{{ route('profile.edit') }}"
                class="mt-3 block py-2 text-sm font-semibold text-zinc-700 hover:text-red-700">
                Mi perfil
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit"
                    class="text-sm font-bold text-red-700 hover:text-red-900">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</nav>
