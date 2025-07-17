<nav class="bg-blue-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-8" src="{{ asset('images/logo-dinas.png') }}" alt="Logo Dinas PU">
                    <span class="ml-2 text-white text-lg font-semibold">Dinas PU</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href=""
                        class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                        Beranda
                    </a>
                    <a href=""
                        class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                        Lapor Masalah
                    </a>
                    <a href=""
                        class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                        Bidang
                    </a>
                    <a href=""
                        class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                        Tentang
                    </a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center text-white hover:text-blue-200 transition duration-300">
                            <span class="mr-2">{{ Auth::user()->nama }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1">
                                <a href=""
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-300">Dashboard</a>
                                <a href=""
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-300">Profile</a>
                                <hr class="my-1">
                                <a href=""
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-300"
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

                <!-- Mobile menu button -->
                <button type="button" class="md:hidden tewext-white hover:text-blue-200 transition duration-300"
                    id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href=""
                    class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                <a href=""
                    class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Lapor
                    Masalah</a>
                <a href=""
                    class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Bidang</a>
                <a href=""
                    class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Tentang</a>
            </div>
        </div>
    </div>
</nav>
