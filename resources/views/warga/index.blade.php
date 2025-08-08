@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if (session('success'))
                <div class="mb-6">
                    <div class="rounded-md bg-green-100 border border-green-300 p-4 text-green-800">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6">
                    <div class="rounded-md bg-red-100 border border-red-300 p-4 text-red-800">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->nama }}!</h1>
                    <p class="mt-2 text-blue-100">Dashboard pribadi untuk memantau laporan dan aktivitas Anda</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="flex items-center text-blue-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ date('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @include('partials.dashboard-stats', [
                'title' => 'Total Laporan',
                'value' => $laporanSaya,
                'subtitle' => 'Yang pernah dibuat',
                'bgColor' => 'bg-blue-100',
                'textColor' => 'text-blue-600',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                                                            </svg>',
            ])

            @include('partials.dashboard-stats', [
                'title' => 'Laporan Pending',
                'value' => $laporanPending,
                'subtitle' => 'Proses Interview',
                'bgColor' => 'bg-yellow-100',
                'textColor' => 'text-yellow-600',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                                                            </svg>',
            ])

            @include('partials.dashboard-stats', [
                'title' => 'Laporan Diterima',
                'value' => $laporanSelesai,
                'subtitle' => 'Laporan Selesai',
                'bgColor' => 'bg-green-100',
                'textColor' => 'text-green-600',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                                                            </svg>',
            ])

            @include('partials.dashboard-stats', [
                'title' => 'Rata-rata Selesai',
                'value' => $rataSelesai,
                'subtitle' => 'Rata-rata penyelesaian',
                'bgColor' => 'bg-purple-100',
                'textColor' => 'text-purple-600',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                                                                            </svg>',
            ])
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Aksi Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @include('partials.quick-action', [
                    'title' => 'Buat Laporan Baru',
                    'description' => 'Laporkan masalah infrastruktur',
                    'link' => route('warga.buat.laporan'),
                    'bgColor' => 'bg-blue-100',
                    'hoverColor' => 'bg-blue-200',
                    'iconColor' => 'text-blue-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                                                                                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Tracking Laporan',
                    'description' => 'Pantau status laporan Anda',
                    'link' => route('warga.laporan'),
                    'bgColor' => 'bg-green-100',
                    'hoverColor' => 'bg-green-200',
                    'iconColor' => 'text-green-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                                                                                                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Edit Profile',
                    'description' => 'Perbarui informasi pribadi',
                    'link' => route('warga.profile'),
                    'bgColor' => 'bg-purple-100',
                    'hoverColor' => 'bg-purple-200',
                    'iconColor' => 'text-purple-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                                                                                                </svg>',
                ])
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="grid grid-cols-1">
            <!-- My Recent Reports -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Laporan Terbaru Saya</h2>
                    <a href="" class="text-blue-600 hover:text-blue-800 font-medium transition duration-300">
                        Lihat Semua →
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($recent_reports ?? [] as $laporan)
                        @include('partials.laporan-card', ['laporan' => $laporan])
                    @empty
                        <div class="bg-gray-50 rounded-lg p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada laporan</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai membuat laporan masalah infrastruktur</p>
                            <div class="mt-6">
                                <a href=""
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                                    Buat Laporan Pertama
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="mt-8 bg-blue-50 rounded-lg p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Tips untuk Laporan yang Efektif</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Berikan deskripsi yang jelas dan detail tentang masalah</li>
                            <li>Sertakan foto jika memungkinkan untuk memperjelas kondisi</li>
                            <li>Cantumkan lokasi yang spesifik dan mudah ditemukan</li>
                            <li>Periksa status laporan secara berkala melalui menu tracking</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto refresh setiap 5 menit untuk update status
        setInterval(function() {
            // Hanya refresh bagian statistik tanpa reload full page
            if (document.visibilityState === 'visible') {
                window.location.reload();
            }
        }, 300000); // 5 menit
    </script>
@endpush
