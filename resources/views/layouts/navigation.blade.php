<nav x-data="{ open: false }" class="bg-white sm:border-b sm:border-slate-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <img src="{{ asset('img/activity.png') }}" class="h-12 w-auto rounded-full" />
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @auth
                        @if (auth()->user()->role == 'admiral')
                            <x-nav-link :href="route('d.dashboard')" :active="request()->routeIs('d.dashboard')">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('d.kriteria.index')" :active="request()->routeIs('d.kriteria.*')">
                                Kriteria
                            </x-nav-link>
                            <x-nav-link :href="route('d.representasi.index')" :active="request()->routeIs('d.representasi.*')">
                                Representasi
                            </x-nav-link>
                            <x-nav-link :href="route('d.alternatif.index')" :active="request()->routeIs('d.alternatif.*')">
                                Alternatif
                            </x-nav-link>

                        @else
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                Beranda
                            </x-nav-link>
                            <x-nav-link :href="route('rekomendasi.index')" :active="request()->routeIs('rekomendasi.*')">
                                Riwayat
                            </x-nav-link>

                        @endif
                    @endauth

                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')">Profile</x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Login/Register -->
            @guest
                <div class="hidden sm:flex sm:items-center">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700">Log in</a>
                    <span class="mx-4">|</span>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm text-gray-700">Register</a>
                    @endif
                </div>
            @endguest

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        @auth
            <div class="pt-2 pb-3 space-y-1">
                @if (auth()->user()->role == 'admiral')
                    <x-responsive-nav-link :href="route('d.dashboard')" :active="request()->routeIs('d.dashboard')">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('d.kriteria.index')" :active="request()->routeIs('d.kriteria.*')">
                        Kriteria
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('d.representasi.index')" :active="request()->routeIs('d.representasi.*')">
                        Representasi
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('d.alternatif.index')" :active="request()->routeIs('d.alternatif.*')">
                        Alternatif
                    </x-responsive-nav-link>

                @else
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Beranda
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('rekomendasi.index')" :active="request()->routeIs('rekomendasi.*')">
                        Riwayat
                    </x-responsive-nav-link>
                    
                @endif
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')">Profile</x-responsive-nav-link>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        <!-- Login/Register -->
        @guest
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    Login
                </x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        Register
                    </x-responsive-nav-link>
                @endif
            </div>
        @endguest

    </div>
</nav>
