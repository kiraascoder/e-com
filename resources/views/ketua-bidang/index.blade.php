@extends('layouts.app')

@section('title', 'Dashboard Ketua Bidang')

@section('content')
    <!-- Header -->
    @include('partials.dashboard-header', [
        'greeting' => 'Selamat Datang, ' . Auth::user()->nama,
        'roleTitle' => 'Ketua Bidang ' . (Auth::user()->bidang->nama ?? 'PU'),
        'description' => 'Kelola tim dan pantau kinerja bidang ' . (Auth::user()->bidang->nama ?? 'Anda'),
        'bgGradient' => 'from-blue-600 to-blue-800',
        'badgeText' => 'Ketua Bidang',
        'roleIcon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>',
    ])
     @include('partials.flash')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Bidang Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @include('partials.metric-card', [
                'title' => 'Laporan Bidang',
                'value' => $laporanBidang,
                'subtitle' => 'Total laporan masuk',
                'bgColor' => 'bg-blue-100',
                'iconColor' => 'text-blue-600',
                'trend' => ['positive' => true, 'value' => '+5%', 'label' => 'minggu ini'],
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                                                </svg>',
            ])

            @include('partials.metric-card', [
                'title' => 'Tim Rutin',
                'value' => $timRutin,
                'subtitle' => 'Tim tetap aktif',
                'bgColor' => 'bg-green-100',
                'iconColor' => 'text-green-600',
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                                                                </svg>',
            ])

            @include('partials.metric-card', [
                'title' => 'Tim Non-Rutin',
                'value' => $timNonRutin,
                'subtitle' => 'Tim khusus aktif',
                'bgColor' => 'bg-purple-100',
                'iconColor' => 'text-purple-600',
                'trend' => ['positive' => true, 'value' => '+3', 'label' => 'tim baru'],
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                                                                </svg>',
            ])

            @include('partials.metric-card', [
                'title' => 'Laporan Selesai',
                'value' => $laporanSelesai,
                'subtitle' => 'Laporan Selesai',
                'bgColor' => 'bg-yellow-100',
                'iconColor' => 'text-yellow-600',
                'trend' => ['positive' => false, 'value' => '68%', 'label' => 'dari alokasi'],
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                                                </svg>',
            ])
        </div>

        <!-- Management Actions -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Manajemen Bidang</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @include('partials.quick-action', [
                    'title' => 'Kelola Tim',
                    'description' => 'Atur anggota dan jadwal tim',
                    'bgColor' => 'bg-blue-100',
                    'link' => route('ketua.tim'),
                    'hoverColor' => 'bg-blue-200',
                    'iconColor' => 'text-blue-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path                                                                                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Daftar Laporan',
                    'description' => 'Daftar Laporan Warga',
                    'bgColor' => 'bg-green-100',
                    'link' => route('ketua.laporan'),
                    'hoverColor' => 'bg-green-200',
                    'iconColor' => 'text-green-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                                                                                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Laporan Kinerja',
                    'description' => 'Review progress tim',
                    'bgColor' => 'bg-purple-100',
                    'link' => route('ketua.review'),
                    'hoverColor' => 'bg-purple-200',
                    'iconColor' => 'text-purple-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                                                                                                </svg>',
                ])
            </div>
        </div>        
    </div>
@endsection
