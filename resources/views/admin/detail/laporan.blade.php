{{-- resources/views/laporan/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- Header --}}
        <div class="flex items-start justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $laporan->judul ?? '—' }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    ID: {{ $laporan->id ?? '—' }}
                </p>
            </div>

            {{-- Status badge --}}
            @php
                $status = $laporan->status_verifikasi ?? 'Belum Diverifikasi';
                $statusClasses = [
                    'Menunggu' => 'bg-yellow-100 text-yellow-800',
                    'Ditolak' => 'bg-red-100 text-red-800',
                    'Diterima' => 'bg-green-100 text-green-800',
                ];
                $badgeClass = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }} capitalize">
                {{ $status }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Kolom Kiri: Info Utama --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Deskripsi --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Deskripsi</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($laporan->deskripsi ?? '—')) !!}
                    </div>
                </div>

                {{-- Foto / Bukti --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Bukti Foto</h2>
                    @php
                        // Jika disimpan di storage, gunakan Storage::url
                        // Pastikan sudah: use Illuminate\Support\Facades\Storage; di controller atau helper tersedia di Blade.
                        $fotoPath = $laporan->foto ?? null;
                        // Coba tebak apakah path storage atau URL langsung
                        $isUrl =
                            $fotoPath &&
                            (str_starts_with($fotoPath, 'http://') || str_starts_with($fotoPath, 'https://'));
                        $imgUrl = $fotoPath
                            ? ($isUrl
                                ? $fotoPath
                                : (Storage::disk('public')->exists($fotoPath)
                                    ? Storage::url($fotoPath)
                                    : null))
                            : null;
                    @endphp

                    @if ($imgUrl)
                        <img src="{{ $imgUrl }}" alt="Bukti Foto"
                            class="rounded-lg w-full object-cover max-h-[420px]">
                    @else
                        <p class="text-sm text-gray-500">Tidak ada foto atau file tidak ditemukan.</p>
                    @endif
                </div>

                {{-- Keterkaitan Tim Non Rutin (jika ada) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Tim Non Rutin yang Menangani</h2>

                    @if ($laporan->timNonRutin)
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Nama Tim</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $laporan->timNonRutin->nama_tim ?? '—' }}
                                </p>

                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Penanggung Jawab</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $laporan->timNonRutin->penanggungJawab?->name ?? 'Belum ditetapkan' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $laporan->timNonRutin->penanggungJawab?->email ?? '—' }}
                                    </p>
                                </div>
                            </div>

                            {{-- <div class="text-right">
                                <a href="{{ route('ketuaBidang.timNonRutin.show', $laporan->timNonRutin->id) }}"
                                    class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-gray-200 hover:bg-gray-50">
                                    Lihat Tim
                                </a>
                            </div> --}}
                        </div>

                        {{-- Daftar Anggota Tim --}}
                        <div class="mt-5">
                            <p class="text-sm font-semibold text-gray-900 mb-2">Anggota</p>
                            <div class="space-y-2">
                                @forelse ($laporan->timNonRutin->anggota as $anggota)
                                    <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $anggota->name }}</p>
                                            <p class="text-xs text-gray-500">Email: {{ $anggota->email }}</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            Bergabung: {{ $anggota->pivot?->created_at?->format('d M Y') ?? '—' }}
                                        </p>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">Belum ada anggota.</p>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Belum ditangani tim non rutin.</p>
                    @endif
                </div>
            </div>

            {{-- Kolom Kanan: Metadata --}}
            <div class="space-y-6">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Informasi Pelapor</h2>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="text-gray-500">Nama Pelapor:</span>
                            <span class="font-medium text-gray-900">
                                {{ $laporan->nama_pelapor ?? ($laporan->user?->name ?? '—') }}
                            </span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Kontak:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->kontak_pelapor ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Akun Pelapor:</span>
                            <span class="font-medium text-gray-900">
                                {{ $laporan->user?->email ?? '—' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Detail Lokasi & Bidang</h2>
                    <div class="space-y-1">
                        <p class="text-sm">
                            <span class="text-gray-500">Alamat:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->alamat ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Bidang:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->bidang?->nama ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Tanggal Laporan:</span>
                            <span class="font-medium text-gray-900">
                                {{ $laporan->tanggal_laporan?->format('d M Y') ?? ($laporan->tanggal_laporan ? \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d M Y') : '—') }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Aksi</h2>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex items-center px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-sm font-medium">
                            Kembali
                        </a>

                        {{-- Contoh tombol aksi lain (sesuaikan route & policy) --}}
                        @can('update', $laporan)
                            <a href="{{ route('laporan.edit', $laporan->id) }}"
                                class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium">
                                Edit Laporan
                            </a>
                        @endcan

                        @can('delete', $laporan)
                            <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST"
                                onsubmit="return confirm('Hapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 text-sm font-medium">
                                    Hapus
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection