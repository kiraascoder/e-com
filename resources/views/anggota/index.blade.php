@extends('layouts.app')

@section('title', 'Dashboard Anggota')

@section('content')
    <!-- Header -->
    @include('partials.dashboard-header', [
        'greeting' => 'Selamat Datang, ' . Auth::user()->nama,
        'roleTitle' => 'Anggota Tim ' . (Auth::user()->current_team ?? 'PU'),
        'description' => 'Kelola tugas dan laporkan progress pekerjaan lapangan',
        'bgGradient' => 'from-green-600 to-green-800',
        'badgeText' => 'Anggota Tim',
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
                'bgColor' => 'bg-green-100',
                'iconColor' => 'text-green-600',
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
                    'title' => 'Update Progress',
                    'description' => 'Laporkan kemajuan tugas',
                    'link' => route('anggota.tasks.update'),
                    'bgColor' => 'bg-blue-100',
                    'hoverColor' => 'bg-blue-200',
                    'iconColor' => 'text-blue-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Upload Foto',
                    'description' => 'Dokumentasi lapangan',
                    'link' => route('anggota.photos.upload'),
                    'bgColor' => 'bg-green-100',
                    'hoverColor' => 'bg-green-200',
                    'iconColor' => 'text-green-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Jadwal Tim',
                    'description' => 'Lihat jadwal kerja',
                    'link' => route('anggota.schedule.index'),
                    'bgColor' => 'bg-purple-100',
                    'hoverColor' => 'bg-purple-200',
                    'iconColor' => 'text-purple-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>',
                ])

                @include('partials.quick-action', [
                    'title' => 'Laporan Harian',
                    'description' => 'Buat laporan aktivitas',
                    'link' => route('anggota.reports.daily'),
                    'bgColor' => 'bg-yellow-100',
                    'hoverColor' => 'bg-yellow-200',
                    'iconColor' => 'text-yellow-600',
                    'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>',
                ])
            </div>
        </div>

        <!-- Current Tasks & Schedule -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Current Tasks -->
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Tugas Saat Ini</h2>
                <div class="space-y-6">
                    @foreach ($current_tasks ?? [] as $task)
                        @include('partials.task-card', ['task' => $task])
                    @endforeach
                </div>
            </div>

            <!-- Today's Schedule & Notifications -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Jadwal Hari Ini</h2>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Agenda</h3>
                        <div class="space-y-3">
                            @foreach ($today_schedule ?? [] as $schedule)
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $schedule['title'] ?? 'Inspeksi Jalan Utama' }}</p>
                                        <p class="text-xs text-gray-500">{{ $schedule['time'] ?? '09:00 - 12:00' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notifikasi</h3>
                        <div class="space-y-3">
                            @foreach ($notifications ?? [] as $notification)
                                <div class="flex items-start space-x-3">
                                    <div class="p-1 bg-yellow-100 rounded-full">
                                        <svg class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 17h5l-5 5v-5z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">
                                            {{ $notification['message'] ?? 'Tugas baru ditugaskan' }}</p>
                                        <p class="text-xs text-gray-500">{{ $notification['time'] ?? '1 jam lalu' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
