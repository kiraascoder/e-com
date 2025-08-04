@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
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
                    <a href=""
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                        Lapor Masalah
                    </a>
                    <a href=""
                        class="border-2 border-white text-white hover:bg-white hover:text-blue-800 px-8 py-3 rounded-lg font-semibold transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Statistik Kinerja</h2>
                <p class="text-lg text-gray-600">Data real-time kinerja Dinas PU dalam melayani masyarakat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @include('partials.stats-card', [
                    'title' => 'Total Laporan',
                    'value' => $stats['total_laporan'] ?? '1,247',
                    'color' => 'blue',
                    'trend' => ['positive' => true, 'value' => '+12%', 'label' => 'bulan ini'],
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                                                                </svg>',
                ])

                @include('partials.stats-card', [
                    'title' => 'Laporan Selesai',
                    'value' => $stats['laporan_selesai'] ?? '892',
                    'color' => 'green',
                    'trend' => ['positive' => true, 'value' => '+8%', 'label' => 'dari target'],
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                                                                </svg>',
                ])

                @include('partials.stats-card', [
                    'title' => 'Tim Aktif',
                    'value' => $stats['tim_aktif'] ?? '24',
                    'color' => 'purple',
                    'trend' => ['positive' => true, 'value' => '+3', 'label' => 'tim baru'],
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                                                                                </svg>',
                ])

                @include('partials.stats-card', [
                    'title' => 'Anggaran Terpakai',
                    'value' => 'Rp ' . ($stats['anggaran_terpakai'] ?? '12,5M'),
                    'color' => 'yellow',
                    'trend' => ['positive' => false, 'value' => '75%', 'label' => 'dari total'],
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                                                                </svg>',
                ])
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

                @include('partials.feature-card', [
                    'title' => 'Manajemen Anggaran',
                    'description' => 'Transparansi penggunaan anggaran untuk setiap proyek dan kegiatan',
                
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                                                                                </svg>',
                ])

                @include('partials.feature-card', [
                    'title' => 'Bidang Kerja',
                    'description' => 'Informasi lengkap tentang bidang-bidang kerja dan tim yang menangani',
                
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                                                                                </svg>',
                ])

                @include('partials.feature-card', [
                    'title' => 'Laporan & Analisis',
                    'description' => 'Dashboard komprehensif dengan analisis data dan laporan kinerja',
                
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
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

                <div class="text-center">
                    <a href=""
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-300 transform hover:scale-105 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Laporan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Activity Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Aktivitas Terbaru</h2>
                <p class="text-lg text-gray-600">Update terkini dari kegiatan Dinas PU</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Reports -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Laporan Terbaru
                    </h3>
                    <div class="space-y-4">
                        @foreach (($recent_reports ?? collect(['Perbaikan Jalan Raya Utama', 'Penanganan Jembatan Rusak', 'Normalisasi Saluran Air']))->take(3) as $index => $reportTitle)
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-medium text-gray-900">{{ $reportTitle }}</h4>
                                    <span
                                        class="text-xs text-gray-500">{{ ['2 jam lalu', '1 hari lalu', '3 hari lalu'][$index] }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ Str::limit(['Jalan mengalami kerusakan parah di beberapa titik', 'Jembatan mengalami retak struktur yang memerlukan perbaikan segera', 'Saluran air tersumbat menyebabkan banjir'][$index], 80) }}
                                </p>
                                <span
                                    class="inline-block px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                    {{ ['Dalam Proses', 'Menunggu Tim', 'Selesai'][$index] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-center">
                        <a href="" class="text-blue-600 hover:text-blue-800 font-medium transition duration-300">
                            Lihat Semua Laporan →
                        </a>
                    </div>
                </div>

                <!-- Recent Teams Activity -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        Aktivitas Tim
                    </h3>
                    <div class="space-y-4">
                        @foreach (($team_activities ?? collect(['Tim Infrastruktur Jalan', 'Tim Pemeliharaan Jembatan', 'Tim Drainase']))->take(3) as $index => $teamName)
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-medium text-gray-900">{{ $teamName }}</h4>
                                    <span
                                        class="text-xs text-gray-500">{{ ['1 hari lalu', '2 hari lalu', '3 hari lalu'][$index] }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ ['Menyelesaikan perbaikan jalan di Jl. Sudirman', 'Melakukan inspeksi rutin jembatan kota', 'Membersihkan saluran drainase utama'][$index] }}
                                </p>
                                <span
                                    class="inline-block px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    {{ ['Selesai', 'Dalam Progress', 'Selesai'][$index] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-center">
                        <a href="" class="text-green-600 hover:text-green-800 font-medium transition duration-300">
                            Lihat Semua Aktivitas →
                        </a>
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
