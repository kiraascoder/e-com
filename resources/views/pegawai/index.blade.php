    @extends('layouts.app')

    @section('title', 'Dashboard Anggota')

    @section('content')
        <!-- Header -->
        @include('partials.dashboard-header', [
            'greeting' => 'Selamat Datang, ' . Auth::user()->nama,
            'roleTitle' => (Auth::user()->name ?? 'Pegawai'),
            'description' => 'Kelola tugas dan laporkan progress pekerjaan lapangan',
            'bgGradient' => 'from-blue-600 to-blue-800',
            'badgeText' => 'Pegawai',
            'roleIcon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>',
        ])

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Personal Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @include('partials.metric-card', [
                    'title' => 'Tugas Aktif',
                    'value' => $metrics['active_tasks'] ?? '5',
                    'subtitle' => 'Sedang dikerjakan',
                    'bgColor' => 'bg-blue-100',
                    'iconColor' => 'text-blue-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                                                                                                            </svg>',
                ])

                @include('partials.metric-card', [
                    'title' => 'Selesai Bulan Ini',
                    'value' => $metrics['completed_month'] ?? '12',
                    'subtitle' => 'Tugas diselesaikan',
                    'bgColor' => 'bg-blue-100',
                    'iconColor' => 'text-blue-600',
                    'trend' => ['positive' => true, 'value' => '+3', 'label' => 'dari target'],
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                                                                            </svg>',
                ])

                @include('partials.metric-card', [
                    'title' => 'Overdue',
                    'value' => $metrics['overdue_tasks'] ?? '1',
                    'subtitle' => 'Tugas terlambat',
                    'bgColor' => 'bg-red-100',
                    'iconColor' => 'text-red-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                                                                            </svg>',
                ])

                @include('partials.metric-card', [
                    'title' => 'Rating Kinerja',
                    'value' => $metrics['performance_rating'] ?? '4.8',
                    'subtitle' => 'Rata-rata rating',
                    'bgColor' => 'bg-yellow-100',
                    'iconColor' => 'text-yellow-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                                                                                            </svg>',
                ])
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Aksi Cepat</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @include('partials.quick-action', [
                        'title' => 'Tim Saya',
                        'description' => 'Tim yang kamu ikuti',
                        'link' => route('pegawai.tim'),
                        'bgColor' => 'bg-blue-100',
                        'hoverColor' => 'bg-blue-200',
                        'iconColor' => 'text-blue-600',
                        'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                                                                                                                                                </svg>',
                    ])

                    @include('partials.quick-action', [
                        'title' => 'Laporan Masuk',
                        'description' => 'Laporan pekerjaan masuk',
                        'link' => route('pegawai.laporan'),
                        'bgColor' => 'bg-blue-100',
                        'hoverColor' => 'bg-blue-200',
                        'iconColor' => 'text-blue-600',
                        'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                                                                                                                </svg>',
                    ])
                    @include('partials.quick-action', [
                        'title' => 'Laporan Tugas',
                        'description' => 'Laporan pekerjaan lapangan',
                        'link' => route('pegawai.task'),
                        'bgColor' => 'bg-blue-100',
                        'hoverColor' => 'bg-blue-200',
                        'iconColor' => 'text-blue-600',
                        'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                                                                                                                </svg>',
                    ])
                </div>
            </div>
        </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            // Auto-refresh for real-time updates
            setInterval(function() {
                // Refresh notification panel every 2 minutes
                if (document.visibilityState === 'visible') {
                    fetch('/api/notifications/latest')
                        .then(response => response.json())
                        .then(data => {
                            // Update notification panel
                            console.log('Notifications updated');
                        });
                }
            }, 120000); // 2 minutes
        </script>
    @endpush
