@extends('layouts.app')

@section('title', 'Detail Laporan Tugas')

@section('content')
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Detail Laporan Tugas</h1>
                    <p class="mt-1 text-blue-100">Tinjau rincian laporan tugas, tim, dan laporan warga yang ditangani</p>
                </div>
                <a href="{{ route('ketua.review') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    @php
        $team = $laporanTugas->timNonRutin;
        $pj = $laporanTugas->penanggungJawab;
        $lap = $laporanTugas->laporan;
        $statusVerif = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'diterima' => 'bg-blue-100 text-blue-800',
            'ditolak' => 'bg-red-100 text-red-800',
        ];
        $statusProc = [
            'menunggu' => 'bg-gray-100 text-gray-800',
            'diproses' => 'bg-indigo-100 text-indigo-800',
            'ditunda' => 'bg-orange-100 text-orange-800',
            'selesai' => 'bg-green-100 text-green-800',
        ];
        $statusReview = $laporanTugas->status_review ?? 'pending';
        $statusReviewColors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'revision' => 'bg-red-100 text-red-800',
        ];
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom kiri: Laporan Tugas -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
                    <div class="flex items-start justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Laporan Tugas</h3>
                        <span
                            class="px-2 py-1 text-xs font-medium rounded-full {{ $statusReviewColors[$statusReview] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusReview === 'pending' ? 'Pending Review' : ($statusReview === 'approved' ? 'Disetujui' : 'Perlu Revisi') }}
                        </span>
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Tanggal</p>
                            <p class="text-gray-900 font-medium">
                                {{ \Illuminate\Support\Carbon::parse($laporanTugas->tanggal)->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Penanggung Jawab</p>
                            <p class="text-gray-900 font-medium">{{ $pj->name ?? '—' }} <span
                                    class="text-gray-500 text-xs">({{ $pj->email ?? '—' }})</span></p>
                        </div>
                        <div>
                            <p class="text-gray-500">Anggaran</p>
                            <p class="text-gray-900 font-medium">
                                {{ $laporanTugas->anggaran ? 'Rp ' . number_format($laporanTugas->anggaran, 2, ',', '.') : '—' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Sumber Anggaran</p>
                            <p class="text-gray-900 font-medium">{{ $laporanTugas->sumber_anggaran ?? '—' }}</p>
                        </div>
                    </div>
                    @if ($laporanTugas->catatan_anggaran)
                        <div class="mt-4">
                            <p class="text-gray-500 text-sm">Catatan Anggaran</p>
                            <p class="text-gray-800 text-sm leading-relaxed">{{ $laporanTugas->catatan_anggaran }}</p>
                        </div>
                    @endif
                    <div class="mt-4">
                        <p class="text-gray-500 text-sm">Deskripsi Pekerjaan</p>
                        <p class="text-gray-800 text-sm leading-relaxed">{{ $laporanTugas->deskripsi }}</p>
                    </div>
                </div>

                <!-- Laporan Warga yang Ditangani -->
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Laporan Warga Ditangani</h3>
                    @if ($lap)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Kode</p>
                                <p class="text-gray-900 font-medium">{{ $lap->kode_laporan ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Judul</p>
                                <p class="text-gray-900 font-medium">{{ $lap->judul }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Alamat</p>
                                <p class="text-gray-900 font-medium">{{ $lap->alamat }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div>
                                    <p class="text-gray-500">Verifikasi</p>
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $statusVerif[$lap->status_verifikasi] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($lap->status_verifikasi) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-gray-500">Penanganan</p>
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $statusProc[$lap->status_penanganan] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($lap->status_penanganan) }}
                                    </span>
                                </div>
                            </div>
                            @if ($lap->tanggal_selesai)
                                <div>
                                    <p class="text-gray-500">Tanggal Selesai</p>
                                    <p class="text-gray-900 font-medium">
                                        {{ \Illuminate\Support\Carbon::parse($lap->tanggal_selesai)->format('d M Y') }}
                                    </p>
                                </div>
                            @endif
                        </div>
                        @if ($lap->foto)
                            <div class="mt-4">
                                <p class="text-gray-500 text-sm mb-2">Foto Laporan</p>
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($lap->foto) }}" alt="Foto Laporan"
                                    class="w-full max-h-72 object-cover rounded-lg border">
                            </div>
                        @endif
                    @else
                        <p class="text-gray-600">Tidak ada referensi laporan warga.</p>
                    @endif
                </div>
            </div>

            <!-- Kolom kanan: Info Tim -->
            <div>
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tim</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-500">Nama Tim</p>
                            <p class="text-gray-900 font-medium">{{ $team->nama_tim ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Penanggung Jawab</p>
                            <p class="text-gray-900 font-medium">{{ $team->penanggungJawab->name ?? '—' }}</p>
                            <p class="text-gray-500">{{ $team->penanggungJawab->email ?? '' }}</p>
                        </div>
                        @if (!empty($team->deskripsi))
                            <div>
                                <p class="text-gray-500">Deskripsi Tim</p>
                                <p class="text-gray-900">{{ $team->deskripsi }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-gray-500">Dibentuk</p>
                            <p class="text-gray-900">{{ optional($team->created_at)->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                @if (isset($laporanTugas->status_review, $laporanTugas->rating_review, $laporanTugas->catatan_review))
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Hasil Review</h3>
                        <p class="text-sm"><span class="text-gray-500">Status:</span>
                            <b>{{ ucfirst($laporanTugas->status_review) }}</b>
                        </p>
                        <p class="text-sm mt-1"><span class="text-gray-500">Rating:</span>
                            <b>{{ $laporanTugas->rating_review }}/5</b>
                        </p>
                        @if ($laporanTugas->catatan_review)
                            <p class="text-sm text-gray-700 mt-2">{{ $laporanTugas->catatan_review }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
