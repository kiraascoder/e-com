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
                    <select id="statusFilter"
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="diterima">Diterima</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="text-sm text-gray-500" id="totalCounter">
                    Total: {{ count($laporan ?? []) }} laporan
                </div>
            </div>
        </div>

        <!-- Laporan List -->
        <div class="space-y-4" id="laporanContainer">
            @forelse ($laporan ?? [] as $item)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 laporan-card"
                    data-status="{{ $item->status_verifikasi ?? ($item['status_verifikasi'] ?? 'pending') }}">
                    <div class="flex items-start justify-between">
                        <div class="flex-2">
                            <div class="flex items-center space-x-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $item->judul ?? ($item['judul'] ?? 'Judul tidak tersedia') }}
                                </h3>

                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'diterima' => 'bg-blue-100 text-blue-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'ditolak' => 'bg-red-100 text-red-800',
                                    ];
                                    $status = strtolower($item->status ?? ($item['status'] ?? 'pending'));
                                @endphp

                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($status) }}
                                </span>

                                <div class="ml-auto">
                                    <a href="{{ route('warga.laporan.show', ['id' => $item->id ?? $item['id']]) }}"
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-gray-800">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $item->alamat ?? ($item['alamat'] ?? 'alamat tidak tersedia') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ isset($item->created_at) ? $item->created_at->format('d M Y') : $item['tanggal'] ?? 'Tanggal tidak tersedia' }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="text-sm text-gray-700">
                                    {{ $item->deskripsi ?? ($item['deskripsi'] ?? 'Deskripsi tidak tersedia') }}
                                </p>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                @php
                                    $progress = [
                                        'pending' => 25,
                                        'diterima' => 60,
                                        'selesai' => 100,
                                        'ditolak' => 0,
                                    ];
                                    $currentProgress = $progress[$status] ?? 25;
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
                                    Pending
                                </div>
                                <div
                                    class="flex items-center {{ $currentProgress >= 60 ? 'text-blue-600' : 'text-gray-400' }}">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $currentProgress >= 60 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                    </div>
                                    Diterima
                                </div>
                                <div
                                    class="flex items-center {{ $currentProgress >= 100 ? 'text-blue-600' : 'text-gray-400' }}">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $currentProgress >= 100 ? 'bg-blue-600' : 'bg-gray-300' }} mr-1">
                                    </div>
                                    Selesai
                                </div>
                            </div>

                            @if ($item->keterangan ?? ($item['keterangan'] ?? null))
                                <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-600">
                                        <strong>Keterangan:</strong> {{ $item->keterangan ?? $item['keterangan'] }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if ($status === 'selesai')
                            <div class="flex flex-col space-y-2 ml-4">
                                <button
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">
                                    Beri Rating
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Laporan</h3>
                    <p class="text-gray-500 mb-4">Anda belum memiliki laporan apapun. Mulai buat laporan pertama Anda!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if (isset($laporan) && method_exists($laporan, 'hasPages') && $laporan->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $laporan->links() }}
            </div>
        @elseif(isset($laporan) && count($laporan) > 0)
            <div class="mt-6 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                        ← Sebelumnya
                    </button>
                    <button class="px-3 py-2 text-sm bg-blue-600 text-white rounded">1</button>
                    <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                        Selanjutnya →
                    </button>
                </nav>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('statusFilter');
            const totalCounter = document.getElementById('totalCounter');

            function applyFilters() {
                const selectedStatus = statusFilter.value;
                const laporanCards = document.querySelectorAll('.laporan-card');
                let visibleCount = 0;

                laporanCards.forEach(card => {
                    const cardStatus = card.dataset.status;
                    const statusMatch = !selectedStatus || cardStatus === selectedStatus;

                    if (statusMatch) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                totalCounter.textContent = `Total: ${visibleCount} laporan`;
            }

            statusFilter.addEventListener('change', applyFilters);
        });
    </script>
@endpush
