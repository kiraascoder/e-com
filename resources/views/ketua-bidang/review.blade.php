@extends('layouts.app')

@section('title', 'Review Laporan Tim')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Review Laporan Tim</h1>
                    <p class="mt-1 text-blue-100">Review dan evaluasi laporan tugas dari tim non-rutin di bidang Anda</p>
                </div>
                <a href="{{ route('ketua.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Summary Cards -->
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Laporan Masuk</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_reports'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Pending Review</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_review'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Disetujui</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['approved'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Perlu Revisi</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['needs_revision'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Filter -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-4 mb-6">
            <form method="GET" action="">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                    <div class="flex flex-wrap gap-3">
                        {{-- Status review (aktif jika kolom status_review memang ada di DB) --}}
                        <select name="status_review"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-purple-500">
                            <option value="">Semua Status Review</option>
                            <option value="pending" {{ request('status_review') === 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="approved" {{ request('status_review') === 'approved' ? 'selected' : '' }}>
                                Disetujui
                            </option>
                            <option value="revision" {{ request('status_review') === 'revision' ? 'selected' : '' }}>Perlu
                                Revisi</option>
                        </select>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-purple-500"
                            placeholder="Cari: judul laporan / tim / PJ">
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Terapkan
                        </button>
                        <a href="{{ route('ketua.review') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- List -->
        <div class="space-y-6">
            @forelse($laporanTugas as $lt)
                @php
                    $team = $lt->timNonRutin;
                    $pj = $lt->penanggungJawab;
                    $lap = $lt->laporan;
                    $statusReview = $lt->status_review ?? 'pending';
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

                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $lap->judul ?? '—' }}
                                </h3>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                    Tim Non-Rutin
                                </span>
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$statusReview] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusText[$statusReview] ?? '—' }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mt-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                                    </svg>
                                    Tim: {{ $team->nama_tim ?? '—' }} (PJ: {{ $pj->name ?? '—' }})
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                    Tanggal Tugas: {{ \Illuminate\Support\Carbon::parse($lt->tanggal)->format('d M Y') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                                    </svg>
                                    Kode: {{ $lap->kode_laporan ?? '—' }}
                                </div>
                            </div>

                            <p class="text-sm text-gray-700 mt-3">
                                <span class="font-semibold">Ringkasan:</span>
                                {{ \Illuminate\Support\Str::limit($lt->deskripsi, 140) }}
                            </p>
                        </div>

                        <div class="ml-6">
                            <a href="{{ route('ketua.review.show', $lt) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg border border-gray-200 p-8 text-center text-gray-600">
                    Belum ada laporan tugas dari pegawai.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($laporanTugas instanceof \Illuminate\Contracts\Pagination\Paginator)
            <div class="mt-6">{{ $laporanTugas->links() }}</div>
        @endif
    </div>
@endsection
