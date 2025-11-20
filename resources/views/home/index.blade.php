@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    @include('partials.flash')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Dinas Pekerjaan Umum
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                    Melayani masyarakat dalam pembangunan dan pemeliharaan infrastruktur untuk kemajuan daerah
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        @php
                            $role = Auth::user()->role ?? null;
                            $targets = [
                                'admin' => [
                                    'route' => 'admin.dashboard',
                                    'label' => 'Dashboard Admin',
                                ],
                                'ketua_bidang' => [
                                    'route' => 'ketua.dashboard',
                                    'label' => 'Dashboard Ketua',
                                ],
                                'pegawai' => [
                                    'route' => 'pegawai.dashboard',
                                    'label' => 'Dashboard Pegawai',
                                ],
                                // 🆕 tambahkan mapping untuk kepala_dinas
                                'kepala_dinas' => [
                                    'route' => 'dinas.dashboard',
                                    'label' => 'Dashboard Kepala Dinas',
                                ],
                            ];
                        @endphp

                        @if ($role && isset($targets[$role]))
                            <a href="{{ route($targets[$role]['route']) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                                {{ $targets[$role]['label'] }}
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                            Masuk
                        </a>
                    @endauth
                    <a href="{{ route('warga.buat.laporan') }}"
                        class="border-2 border-white text-white hover:bg-white hover:text-blue-800 px-8 py-3 rounded-lg font-semibold transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                        Laporkan Masalah
                    </a>

                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan Utama</h2>
                <p class="text-lg text-gray-600">Berbagai layanan yang kami sediakan untuk masyarakat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @include('partials.feature-card', [
                    'title' => 'Pelaporan Masalah',
                    'description' =>
                        'Laporkan masalah infrastruktur dengan mudah dan cepat melalui sistem online kami',
                    'icon' =>
                        '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.062 19h13.876c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.33 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>',
                ])

                @include('partials.feature-card', [
                    'title' => 'Manajemen Tim',
                    'description' =>
                        'Sistem manajemen tim rutin dan non-rutin untuk penanganan masalah yang efektif',
                    'icon' =>
                        '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0m6 3a2 2 0 11-4 0 2 2 0 014 0M7 10a2 2 0 11-4 0 2 2 0 014 0"/></svg>',
                ])

                @include('partials.feature-card', [
                    'title' => 'Tracking Laporan',
                    'description' =>
                        'Pantau status laporan Anda secara real-time dari submission hingga penyelesaian',
                    'icon' =>
                        '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>',
                ])
            </div>
        </div>
    </section>

    <!-- Quick Report Section -->
    <section class="py-16 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Laporkan Masalah Infrastruktur</h2>
                    <p class="text-lg text-gray-600">Bantu kami melayani masyarakat dengan melaporkan masalah infrastruktur
                        di sekitar Anda</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4"
                            aria-hidden="true">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">1. Buat Laporan</h3>
                        <p class="text-gray-600">Isi form laporan dengan detail masalah yang Anda temukan</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4"
                            aria-hidden="true">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">2. Tim Menangani</h3>
                        <p class="text-gray-600">Tim ahli kami akan segera merespons dan menangani laporan Anda</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4"
                            aria-hidden="true">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">3. Masalah Selesai</h3>
                        <p class="text-gray-600">Dapatkan update progress dan konfirmasi penyelesaian masalah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating WhatsApp -->
    <div id="wa-button"
        class="fixed bottom-24 right-6 z-50 hidden opacity-0 scale-95 transform transition duration-200 ease-out">
        <a href="https://wa.me/6281141007777?text=Lapor%20Pak%20Wali" target="_blank" rel="noopener"
            class="flex items-center gap-2 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M20.52 3.48A11.76 11.76 0 0012 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.26-1.62A11.76 11.76 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22a9.83 9.83 0 01-5-1.35l-.36-.21-3.71.96.99-3.61-.23-.37A9.83 9.83 0 012 12C2 6.48 6.48 2 12 2c2.64 0 5.14 1.03 7.03 2.92A9.9 9.9 0 0122 12c0 5.52-4.48 10-10 10zm5.06-7.69c-.27-.13-1.61-.79-1.86-.88-.25-.09-.43-.13-.61.13-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.13-1.14-.42-2.17-1.33-.8-.71-1.33-1.59-1.48-1.86-.16-.27-.02-.42.12-.55.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.13-.61-1.47-.83-2.02-.22-.52-.44-.45-.61-.46h-.52c-.18 0-.48.07-.73.34-.25.27-.95.93-.95 2.26s.97 2.63 1.1 2.81c.14.18 1.91 2.91 4.63 4.08.65.28 1.16.45 1.56.57.65.21 1.24.18 1.71.11.52-.08 1.61-.66 1.84-1.3.23-.64.23-1.19.16-1.3-.07-.11-.25-.18-.52-.3z" />
            </svg>
            <span class="hidden md:inline">Chat WA</span>
            <span class="sr-only">Buka WhatsApp</span>
        </a>
    </div>

    <!-- Toggle FAB -->
    <button id="toggle-wa" type="button" aria-expanded="false" aria-controls="wa-button"
        class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg z-50 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path id="toggle-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35M16.65 9.35a7 7 0 11-9.9 9.9 7 7 0 019.9-9.9z" />
        </svg>
        <span class="sr-only">Tampilkan/sembunyikan tombol WhatsApp</span>
    </button>
@endsection

@push('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Mobile menu toggle (guard agar tidak error jika elemen tidak ada)
        (function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => menu.classList.toggle('hidden'));
            }
        })();

        // WhatsApp toggle logic
        (function() {
            const waButton = document.getElementById('wa-button');
            const toggleWa = document.getElementById('toggle-wa');
            const togglePath = document.getElementById('toggle-icon-path');

            if (!waButton || !toggleWa || !togglePath) return;

            // Start hidden via utility classes
            let isShown = false;

            const showWA = () => {
                isShown = true;
                waButton.classList.remove('hidden', 'opacity-0', 'scale-95');
                waButton.classList.add('opacity-100', 'scale-100');
                toggleWa.setAttribute('aria-expanded', 'true');
                // Icon: ganti ke "X"
                togglePath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            };

            const hideWA = () => {
                isShown = false;
                waButton.classList.add('opacity-0', 'scale-95');
                toggleWa.setAttribute('aria-expanded', 'false');
                // Icon: kembali ke ikon search
                togglePath.setAttribute('d', 'M21 21l-4.35-4.35M16.65 9.35a7 7 0 11-9.9 9.9 7 7 0 019.9-9.9z');
                // Tunggu transisi sebelum disembunyikan (hindari flash)
                setTimeout(() => {
                    if (!isShown) waButton.classList.add('hidden');
                }, 180);
            };

            // Inisialisasi state hidden (kelas sudah diset di HTML)
            hideWA();

            toggleWa.addEventListener('click', () => {
                if (isShown) hideWA();
                else showWA();
            });

            // Optional: tutup saat user menekan Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && isShown) hideWA();
            });

            // Optional: hormati prefers-reduced-motion
            const media = window.matchMedia('(prefers-reduced-motion: reduce)');
            if (media.matches) {
                waButton.classList.remove('transition', 'duration-200');
            }
        })();
    </script>
@endpush
