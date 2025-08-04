@extends('layouts.app')

@section('title', 'Review Laporan Tim')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Review Laporan Tim</h1>
                    <p class="mt-1 text-blue-100">Review dan evaluasi laporan kinerja tim rutin dan non-rutin</p>
                </div>
                <a href="{{ route('ketua.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Laporan Masuk</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_reports'] ?? '45' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Pending Review</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_review'] ?? '12' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Disetujui</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['approved'] ?? '28' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Perlu Revisi</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['needs_revision'] ?? '5' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-4 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div class="flex flex-wrap gap-3">
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">Semua Tim</option>
                        <option value="rutin">Tim Rutin</option>
                        <option value="non_rutin">Tim Non-Rutin</option>
                    </select>
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending Review</option>
                        <option value="approved">Disetujui</option>
                        <option value="revision">Perlu Revisi</option>
                    </select>
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">Periode</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                        <option value="quarter">Kuartal Ini</option>
                    </select>
                </div>
                <div class="text-sm text-gray-500">
                    Total: {{ $total_reports ?? '45' }} laporan
                </div>
            </div>
        </div>

        <!-- Laporan Tim -->
        <div class="space-y-6">
            @forelse($reports ?? [] as $report)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $report['title'] ?? 'Laporan Mingguan Tim Pemeliharaan 1' }}</h3>
                                @php
                                    $teamType = $report['team_type'] ?? 'rutin';
                                    $teamTypeColors = [
                                        'rutin' => 'bg-green-100 text-green-800',
                                        'non_rutin' => 'bg-purple-100 text-purple-800',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $teamTypeColors[$teamType] }}">
                                    {{ $teamType === 'rutin' ? 'Tim Rutin' : 'Tim Non-Rutin' }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    {{ $report['team_name'] ?? 'Tim Pemeliharaan 1' }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $report['period'] ?? '01-07 Des 2024' }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                        </path>
                                    </svg>
                                    {{ $report['tasks_completed'] ?? '12' }} tugas selesai
                                </div>
                            </div>

                            <!-- Progress Summary -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Target:</span>
                                        <span class="font-medium ml-2">{{ $report['target'] ?? '15 tugas' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Realisasi:</span>
                                        <span class="font-medium ml-2">{{ $report['completed'] ?? '12 tugas' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Pencapaian:</span>
                                        <span
                                            class="font-medium ml-2 text-blue-600">{{ $report['achievement'] ?? '80%' }}</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full"
                                            style="width: {{ $report['achievement_percent'] ?? '80' }}%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Summary Points -->
                            <div class="text-sm text-gray-700">
                                <p class="mb-2"><strong>Ringkasan:</strong></p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600">
                                    <li>{{ $report['summary_1'] ?? 'Perbaikan 8 lubang jalan di berbagai lokasi' }}</li>
                                    <li>{{ $report['summary_2'] ?? 'Pembersihan drainase di 4 titik' }}</li>
                                    <li>{{ $report['summary_3'] ?? 'Pemasangan 3 rambu lalu lintas baru' }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="ml-6 flex flex-col items-end space-y-3">
                            @php
                                $status = $report['status'] ?? 'pending';
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'revision' => 'bg-red-100 text-red-800',
                                ];
                                $statusText = [
                                    'pending' => 'Pending Review',
                                    'approved' => 'Disetujui',
                                    'revision' => 'Perlu Revisi',
                                ];
                            @endphp
                            <span class="px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$status] }}">
                                {{ $statusText[$status] }}
                            </span>

                            <div class="flex flex-col space-y-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Detail
                                </button>
                                @if ($status === 'pending')
                                    <button
                                        class="review-btn bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-medium transition duration-300"
                                        data-report-id="{{ $report['id'] ?? $loop->index }}">
                                        Review
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Data dummy untuk contoh -->
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $teamTypes = ['rutin', 'non_rutin'];
                        $statuses = ['pending', 'approved', 'revision'];

                        $randomTeamType = $teamTypes[array_rand($teamTypes)];
                        $randomStatus = $statuses[array_rand($statuses)];

                        $teamTypeColors = [
                            'rutin' => 'bg-green-100 text-green-800',
                            'non_rutin' => 'bg-purple-100 text-purple-800',
                        ];

                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'approved' => 'bg-green-100 text-green-800',
                            'revision' => 'bg-red-100 text-red-800',
                        ];

                        $statusText = [
                            'pending' => 'Pending Review',
                            'approved' => 'Disetujui',
                            'revision' => 'Perlu Revisi',
                        ];

                        $titles = [
                            'Laporan Mingguan Tim Pemeliharaan',
                            'Laporan Proyek Jembatan',
                            'Laporan Emergency Response',
                            'Laporan Renovasi Fasum',
                            'Laporan Tim Darurat',
                            'Laporan Perbaikan Drainase',
                            'Laporan Pemeliharaan Jalan',
                            'Laporan Tim Khusus',
                        ];

                        $teamNames = [
                            'Tim Pemeliharaan 1',
                            'Tim Pemeliharaan 2',
                            'Tim Proyek Jembatan',
                            'Tim Emergency Response',
                            'Tim Renovasi',
                            'Tim Darurat',
                        ];

                        $achievements = [75, 80, 85, 90, 95, 100];
                        $randomAchievement = $achievements[array_rand($achievements)];
                    @endphp
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $titles[$i - 1] }}
                                        {{ $i }}</h3>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $teamTypeColors[$randomTeamType] }}">
                                        {{ $randomTeamType === 'rutin' ? 'Tim Rutin' : 'Tim Non-Rutin' }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        {{ $teamNames[array_rand($teamNames)] }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ sprintf('%02d', $i) }}-{{ sprintf('%02d', $i + 6) }} Des 2024
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                        {{ 10 + $i }} tugas selesai
                                    </div>
                                </div>

                                <!-- Progress Summary -->
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-600">Target:</span>
                                            <span class="font-medium ml-2">{{ 12 + $i }} tugas</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Realisasi:</span>
                                            <span class="font-medium ml-2">{{ 10 + $i }} tugas</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Pencapaian:</span>
                                            <span class="font-medium ml-2 text-blue-600">{{ $randomAchievement }}%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full"
                                                style="width: {{ $randomAchievement }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary Points -->
                                <div class="text-sm text-gray-700">
                                    <p class="mb-2"><strong>Ringkasan:</strong></p>
                                    <ul class="list-disc list-inside space-y-1 text-gray-600">
                                        @if ($randomTeamType === 'rutin')
                                            <li>Perbaikan {{ 5 + $i }} lubang jalan di berbagai lokasi</li>
                                            <li>Pembersihan drainase di {{ 2 + $i }} titik</li>
                                            <li>Pemasangan {{ $i }} rambu lalu lintas baru</li>
                                        @else
                                            <li>Progress pembangunan mencapai {{ $randomAchievement }}%</li>
                                            <li>Koordinasi dengan {{ 2 + $i }} instansi terkait</li>
                                            <li>Penyelesaian {{ $i }} milestone utama</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            <div class="ml-6 flex flex-col items-end space-y-3">
                                <span
                                    class="px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$randomStatus] }}">
                                    {{ $statusText[$randomStatus] }}
                                </span>

                                <div class="flex flex-col space-y-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Lihat Detail
                                    </button>
                                    @if ($randomStatus === 'pending')
                                        <button
                                            class="review-btn bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-medium transition duration-300"
                                            data-report-id="{{ $i }}">
                                            Review
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Menampilkan 1-8 dari {{ $total_reports ?? '45' }} laporan
            </div>
            <nav class="flex items-center space-x-2">
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                    ← Sebelumnya
                </button>
                <button class="px-3 py-2 text-sm bg-blue-600 text-white rounded">1</button>
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700">2</button>
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700">3</button>
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700">
                    Selanjutnya →
                </button>
            </nav>
        </div>
    </div>

    <!-- Modal Review -->
    <div id="modalReview" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Review Laporan Tim</h3>
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Review</label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="approved">Setujui</option>
                                    <option value="revision">Perlu Revisi</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rating Kinerja</label>
                                <div class="flex space-x-2">
                                    <button type="button" class="rating-btn p-2 text-gray-400 hover:text-yellow-400"
                                        data-rating="1">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button type="button" class="rating-btn p-2 text-gray-400 hover:text-yellow-400"
                                        data-rating="2">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button type="button" class="rating-btn p-2 text-gray-400 hover:text-yellow-400"
                                        data-rating="3">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button type="button" class="rating-btn p-2 text-gray-400 hover:text-yellow-400"
                                        data-rating="4">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button type="button" class="rating-btn p-2 text-gray-400 hover:text-yellow-400"
                                        data-rating="5">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Review</label>
                                <textarea rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    placeholder="Berikan feedback untuk tim..."></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalReview"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                Kirim Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Review modal handlers
        document.querySelectorAll('.review-btn').forEach(button => {
            button.addEventListener('click', function() {
                const reportId = this.dataset.reportId;
                document.getElementById('modalReview').classList.remove('hidden');
            });
        });

        document.getElementById('btnBatalReview').addEventListener('click', function() {
            document.getElementById('modalReview').classList.add('hidden');
        });

        // Rating system
        document.querySelectorAll('.rating-btn').forEach(button => {
            button.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                const allStars = document.querySelectorAll('.rating-btn');

                allStars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('text-gray-400');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-400');
                    }
                });
            });
        });

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'modalReview') {
                document.getElementById('modalReview').classList.add('hidden');
            }
        });
    </script>
@endpush
