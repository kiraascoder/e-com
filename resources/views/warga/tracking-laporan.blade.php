@extends('layouts.app')

@section('title', 'Tracking Laporan')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Tracking Laporan</h1>
                    <p class="mt-1 text-blue-100">Pantau status dan perkembangan laporan Anda</p>
                </div>
                <a href="{{ route('warga.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow border border-gray-200 p-4 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <div class="flex space-x-4">
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="proses">Dalam Proses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="jalan">Jalan</option>
                        <option value="drainase">Drainase</option>
                        <option value="jembatan">Jembatan</option>
                        <option value="lampu_jalan">Lampu Jalan</option>
                        <option value="fasilitas_umum">Fasilitas Umum</option>
                    </select>
                </div>
                <div class="text-sm text-gray-500">
                    Total: {{ $laporan_count ?? 12 }} laporan
                </div>
            </div>
        </div>

        <!-- Laporan List -->
        <div class="space-y-4">
            @forelse($laporan ?? [] as $item)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $item['judul'] ?? 'Jalan berlubang di Jl. Merdeka' }}</h3>
                                @php
                                    $statusColors = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'proses' => 'bg-blue-100 text-blue-800',
                                        'selesai' => 'bg-blue-100 text-blue-800',
                                        'ditolak' => 'bg-red-100 text-red-800',
                                    ];
                                    $status = $item['status'] ?? 'proses';
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$status] }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    {{ ucfirst($item['kategori'] ?? 'jalan') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $item['lokasi'] ?? 'Jl. Merdeka No. 123' }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $item['tanggal'] ?? '15 Juli 2024' }}
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                @php
                                    $progress = [
                                        'menunggu' => 25,
                                        'proses' => 60,
                                        'selesai' => 100,
                                        'ditolak' => 0,
                                    ];
                                    $currentProgress = $progress[$status];
                                @endphp
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                                    <span>Progress</span>
                                    <span>{{ $currentProgress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                        style="width: {{ $currentProgress }}%"></div>
                                </div>
                            </div>

                            <!-- Timeline Steps -->
                            <div class="flex items-center space-x-4 text-xs">
                                <div
                                    class="flex items-center {{ $currentProgress >= 25 ? 'text-blue-600' : 'text-gray-400' }}">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $currentProgress >= 25 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                    </div>
                                    Diterima
                                </div>
                                <div
                                    class="flex items-center {{ $currentProgress >= 60 ? 'text-blue-600' : 'text-gray-400' }}">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $currentProgress >= 60 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                    </div>
                                    Diproses
                                </div>
                                <div
                                    class="flex items-center {{ $currentProgress >= 100 ? 'text-blue-600' : 'text-gray-400' }}">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $currentProgress >= 100 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                    </div>
                                    Selesai
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2 ml-4">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">
                                Detail
                            </button>
                            @if ($status === 'selesai')
                                <button
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">
                                    Beri Rating
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Data dummy untuk contoh -->
                @for ($i = 1; $i <= 5; $i++)
                    @php
                        $statuses = ['menunggu', 'proses', 'selesai', 'ditolak'];
                        $categories = ['jalan', 'drainase', 'jembatan', 'lampu_jalan'];
                        $randomStatus = $statuses[array_rand($statuses)];
                        $randomCategory = $categories[array_rand($categories)];

                        $statusColors = [
                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                            'proses' => 'bg-blue-100 text-blue-800',
                            'selesai' => 'bg-blue-100 text-blue-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                        ];

                        $progress = [
                            'menunggu' => 25,
                            'proses' => 60,
                            'selesai' => 100,
                            'ditolak' => 0,
                        ];
                        $currentProgress = $progress[$randomStatus];
                    @endphp
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">Laporan {{ ucfirst($randomCategory) }}
                                        #{{ sprintf('%03d', $i) }}</h3>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$randomStatus] }}">
                                        {{ ucfirst($randomStatus) }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        {{ ucfirst($randomCategory) }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Jl. Merdeka No. {{ $i * 10 }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ date('d M Y', strtotime("-{$i} days")) }}
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                                        <span>Progress</span>
                                        <span>{{ $currentProgress }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                            style="width: {{ $currentProgress }}%"></div>
                                    </div>
                                </div>

                                <!-- Timeline Steps -->
                                <div class="flex items-center space-x-4 text-xs">
                                    <div
                                        class="flex items-center {{ $currentProgress >= 25 ? 'text-blue-600' : 'text-gray-400' }}">
                                        <div
                                            class="w-2 h-2 rounded-full {{ $currentProgress >= 25 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                        </div>
                                        Diterima
                                    </div>
                                    <div
                                        class="flex items-center {{ $currentProgress >= 60 ? 'text-blue-600' : 'text-gray-400' }}">
                                        <div
                                            class="w-2 h-2 rounded-full {{ $currentProgress >= 60 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                        </div>
                                        Diproses
                                    </div>
                                    <div
                                        class="flex items-center {{ $currentProgress >= 100 ? 'text-blue-600' : 'text-gray-400' }}">
                                        <div
                                            class="w-2 h-2 rounded-full {{ $currentProgress >= 100 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                        </div>
                                        Selesai
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col space-y-2 ml-4">
                                <button
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">
                                    Detail
                                </button>
                                @if ($randomStatus === 'selesai')
                                    <button
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">
                                        Beri Rating
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
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
@endsection
