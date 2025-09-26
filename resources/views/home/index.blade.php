@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    @include('partials.flash')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        
        <div class="absolute inset-0 bg-black opacity-20"></div>
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
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                                Dashboard Admin
                            </a>
                        @elseif (Auth::user()->role === 'ketua_bidang')
                            <a href="{{ route('ketua.dashboard') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                                Dashboard Ketua
                            </a>
                        @elseif (Auth::user()->role === 'pegawai')
                            <a href="{{ route('pegawai.dashboard') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                                Dashboard Pegawai
                            </a>
                        @elseif (Auth::user()->role === 'warga')
                            <a href="{{ route('warga.dashboard') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                                Dashboard Warga
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                            Masuk
                        </a>
                    @endauth
                    <a href="{{route('warga.buat.laporan')}}"
                        class="border-2 border-white text-white hover:bg-white hover:text-blue-800 px-8 py-3 rounded-lg font-semibold transition duration-300">
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
                
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                                                                                                                                </svg>',
                ])

                @include('partials.feature-card', [
                    'title' => 'Manajemen Tim',
                    'description' =>
                        'Sistem manajemen tim rutin dan non-rutin untuk penanganan masalah yang efektif',
                
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                                                                                                                                </svg>',
                ])

                @include('partials.feature-card', [
                    'title' => 'Tracking Laporan',
                    'description' =>
                        'Pantau status laporan Anda secara real-time dari submission hingga penyelesaian',
                
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                                                                                                                                                </svg>',
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
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">1. Buat Laporan</h3>
                        <p class="text-gray-600">Isi form laporan dengan detail masalah yang Anda temukan</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">2. Tim Menangani</h3>
                        <p class="text-gray-600">Tim ahli kami akan segera merespons dan menangani laporan Anda</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">3. Masalah Selesai</h3>
                        <p class="text-gray-600">Dapatkan update progress dan konfirmasi penyelesaian masalah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
@endpush
