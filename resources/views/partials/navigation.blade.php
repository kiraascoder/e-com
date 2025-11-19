<nav class="bg-blue-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img class="h-12 w-12 cursor-pointer" src="{{ asset('images/logo-dinas.svg') }}"
                            alt="Logo Dinas PU">
                    </a>
                    <span class="ml-2 text-white text-lg font-semibold">Dinas PU</span>
                </div>

                <!-- Links (desktop) -->
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="/"
                        class="px-3 py-2 rounded-md text-sm font-medium transition duration-300
                            {{ request()->is('/') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                        Beranda
                    </a>
                    <a href="{{ route('bidang.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium transition duration-300
                            {{ request()->is('bidang') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                        Bidang
                    </a>
                    <a href="{{ route('tentang.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium transition duration-300
                            {{ request()->is('tentang') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                        Tentang
                    </a>
                    <a href="{{ route('saran.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium transition duration-300
                            {{ request()->is('saran') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                        Saran
                    </a>
                </div>
            </div>

            <!-- Right side -->
            <div class="flex items-center space-x-4">
                @auth
                    @php
                        $user = Auth::user();
                        $role = $user->role ?? null;

                        $dashboardTargets = [
                            'admin' => [
                                'route' => 'admin.dashboard',
                                'label' => 'Dashboard Admin',
                            ],
                            'ketua_bidang' => [
                                'route' => 'ketua.dashboard',
                                'label' => 'Dashboard Ketua Bidang',
                            ],
                            'pegawai' => [
                                'route' => 'pegawai.dashboard',
                                'label' => 'Dashboard Pegawai',
                            ],
                            'kepala_dinas' => [
                                'route' => 'dinas.dashboard',
                                'label' => 'Dashboard Kepala Dinas',
                            ],
                        ];

                        $dashboardConfig = $role && isset($dashboardTargets[$role]) ? $dashboardTargets[$role] : null;
                    @endphp

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center text-white hover:text-blue-200 transition duration-300">
                            <span class="mr-2">{{ $user->nama }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                {{-- Dashboard (dinamis sesuai role) --}}
                                @if ($dashboardConfig)
                                    <a href="{{ route($dashboardConfig['route']) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ $dashboardConfig['label'] }}
                                    </a>
                                @endif

                                <hr class="my-1">

                                <!-- Logout -->
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                        Masuk
                    </a>
                @endauth

                <!-- Mobile button -->
                <button type="button" class="md:hidden text-white hover:text-blue-200 transition duration-300"
                    id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="/"
                    class="block px-3 py-2 rounded-md text-base font-medium
                        {{ request()->is('/') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                    Beranda
                </a>
                <a href="{{ route('bidang.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium
                        {{ request()->is('bidang') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                    Bidang
                </a>
                <a href="{{ route('tentang.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium
                        {{ request()->is('tentang') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                    Tentang
                </a>
                <a href="{{ route('saran.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium
                        {{ request()->is('saran') ? 'text-white' : 'text-blue-100 hover:text-white' }}">
                    Saran
                </a>
            </div>
        </div>
    </div>
</nav>
