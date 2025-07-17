@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Header -->
    @include('partials.dashboard-header', [
        'greeting' => 'Selamat Datang, ' . Auth::user()->nama,
        'roleTitle' => 'Administrator Sistem',
        'description' => 'Kelola seluruh sistem Dinas PU dan pantau kinerja organisasi',
        'bgGradient' => 'from-red-600 to-red-800',
        'badgeText' => 'Super Admin',
        'roleIcon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>',
    ])

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @include('partials.metric-card', [
                'title' => 'Total Laporan',
                'value' => $metrics['total_laporan'] ?? '2,847',
                'subtitle' => 'Semua laporan masuk',
                'bgColor' => 'bg-blue-100',
                'iconColor' => 'text-blue-600',
                'trend' => ['positive' => true, 'value' => '+12%', 'label' => 'bulan ini'],
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>',
            ])

            @include('partials.metric-card', [
                'title' => 'Total Bidang',
                'value' => $metrics['total_bidang'] ?? '12',
                'subtitle' => 'Bidang aktif',
                'bgColor' => 'bg-green-100',
                'iconColor' => 'text-green-600',
                'trend' => ['positive' => true, 'value' => '+2', 'label' => 'bidang baru'],
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>',
            ])

            @include('partials.metric-card', [
                'title' => 'Total Users',
                'value' => $metrics['total_users'] ?? '148',
                'subtitle' => 'Pengguna terdaftar',
                'bgColor' => 'bg-purple-100',
                'iconColor' => 'text-purple-600',
                'trend' => ['positive' => true, 'value' => '+8%', 'label' => 'minggu ini'],
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>',
            ])

            @include('partials.metric-card', [
                'title' => 'Total Anggaran',
                'value' => 'Rp ' . ($metrics['total_anggaran'] ?? '45.2M'),
                'subtitle' => 'Anggaran terpakai',
                'bgColor' => 'bg-yellow-100',
                'iconColor' => 'text-yellow-600',
                'trend' => ['positive' => false, 'value' => '72%', 'label' => 'dari total'],
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>',
            ])
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Admin Panel</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @include('partials.quick-action', [
                    'title' => 'Kelola Bidang',
                    'description' => 'Tambah dan kelola bidang PU',
                    
                    
                    'bgColor' => 'bg-blue-100',
                    'hoverColor' => 'bg-blue-200',
                    'iconColor' => 'text-blue-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Kelola Users',
                    'description' => 'Manajemen pengguna sistem',
                    
                    'bgColor' => 'bg-green-100',
                    'hoverColor' => 'bg-green-200',
                    'iconColor' => 'text-green-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Laporan Sistem',
                    'description' => 'Lihat laporan dan statistik',                
                    'bgColor' => 'bg-purple-100',
                    'hoverColor' => 'bg-purple-200',
                    'iconColor' => 'text-purple-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Settings',
                    'description' => 'Konfigurasi sistem',
                    
                    'bgColor' => 'bg-gray-100',
                    'hoverColor' => 'bg-gray-200',
                    'iconColor' => 'text-gray-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>',
                ])
            </div>
        </div>

        <!-- Recent Activity & Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Activity -->
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Aktivitas Terbaru Sistem</h2>
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <div class="space-y-4">
                        @foreach ($recent_activities ?? [] as $activity)
                            <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-lg">
                                <div class="p-2 bg-blue-100 rounded-full">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $activity['title'] ?? 'User baru terdaftar' }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $activity['description'] ?? 'Ahmad Santoso mendaftar sebagai anggota' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] ?? '10 menit yang lalu' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Status Tim</h2>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tim Aktif Hari Ini</h3>
                        <div class="space-y-3">
                            @foreach (($active_teams ?? collect(['Tim Infrastruktur', 'Tim Drainase', 'Tim Jembatan']))->take(3) as $team)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">{{ $team }}</span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Laporan Pending</h3>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600">{{ $pending_reports ?? '23' }}</div>
                            <p class="text-sm text-gray-600">Menunggu assignment</p>
                            <a href=""
                                class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-2 inline-block">
                                Lihat Semua →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
