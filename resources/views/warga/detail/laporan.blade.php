@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="max-w-5xl mx-auto p-5 bg-white rounded-md shadow mt-6">
        <!-- Header -->
        <div class="flex items-center justify-between pb-4 border-b">
            <div>
                <h3 class="text-2xl font-semibold text-gray-900">Detail Laporan</h3>
                <p class="text-sm text-gray-500 mt-1">Kode: <span class="font-mono">{{ $laporan->kode_laporan }}</span></p>
            </div>
            <a href="{{ route('warga.laporan') }}" class="text-gray-400 hover:text-gray-600 transition duration-300">
                ← Kembali
            </a>
        </div>

        @php
            // Badge warna status
            $verifColors = [
                'pending' => 'bg-blue-100 text-blue-800',
                'diterima' => 'bg-yellow-100 text-yellow-800',
                'ditolak' => 'bg-red-100 text-red-800',
            ];
            $procColors = [
                'menunggu' => 'bg-gray-100 text-gray-800',
                'diproses' => 'bg-indigo-100 text-indigo-800',
                'selesai' => 'bg-green-100 text-green-800',
                'ditunda' => 'bg-orange-100 text-orange-800',
            ];
            // Progress gabungan verifikasi + penanganan
            $progress = 0;
            if ($laporan->status_verifikasi === 'ditolak') {
                $progress = 0;
            } elseif ($laporan->status_verifikasi === 'pending') {
                $progress = 20;
            } elseif ($laporan->status_verifikasi === 'diterima') {
                $progress = match ($laporan->status_penanganan) {
                    'menunggu' => 40,
                    'diproses' => 70,
                    'ditunda' => 50,
                    'selesai' => 100,
                    default => 40,
                };
            }
            // Helper kecil
            $kategoriLabel = ucwords(str_replace('_', ' ', $laporan->kategori_fasilitas));
            $koor = $laporan->koordinat; // accessor dari model (['lat'=>..,'lng'=>..] atau null)
        @endphp

        <!-- Status Badges -->
        <div class="mt-4 mb-4 flex flex-wrap items-center gap-2">
            <span
                class="px-3 py-1 text-xs font-medium rounded-full {{ $verifColors[$laporan->status_verifikasi] ?? 'bg-gray-100 text-gray-800' }}">
                Verifikasi: {{ ucfirst($laporan->status_verifikasi) }}
            </span>
            <span
                class="px-3 py-1 text-xs font-medium rounded-full {{ $procColors[$laporan->status_penanganan] ?? 'bg-gray-100 text-gray-800' }}">
                Penanganan: {{ ucfirst($laporan->status_penanganan) }}
            </span>
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-sky-100 text-sky-800">
                Kategori: {{ $kategoriLabel }}
            </span>
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-rose-100 text-rose-800">
                Tingkat: {{ ucfirst($laporan->tingkat_kerusakan) }}
            </span>
            @if ($laporan->jenis_kerusakan)
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800">
                    Jenis: {{ $laporan->jenis_kerusakan }}
                </span>
            @endif
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                Kanal: {{ strtoupper($laporan->channel) }}
            </span>
        </div>

        <!-- Info Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-3">
                    {{ $laporan->judul }}
                </h4>

                <div class="space-y-3">
                    <!-- Alamat -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Alamat</p>
                            <p class="text-sm text-gray-600">{{ $laporan->alamat }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $laporan->kelurahan ? 'Kel. ' . $laporan->kelurahan : '' }}
                                {{ $laporan->kecamatan ? ($laporan->kelurahan ? ' — ' : '') . 'Kec. ' . $laporan->kecamatan : '' }}
                            </p>
                            @if ($koor)
                                <a href="https://www.google.com/maps?q={{ $koor['lat'] }},{{ $koor['lng'] }}"
                                    target="_blank" rel="noopener"
                                    class="inline-flex items-center mt-1 text-xs text-blue-600 hover:underline">
                                    Buka di Google Maps ({{ $koor['lat'] }}, {{ $koor['lng'] }})
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Tanggal Lapor</p>
                            <p class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y H:i') }}
                            </p>
                            @if ($laporan->tanggal_selesai)
                                <p class="text-xs text-gray-500 mt-1">
                                    Selesai: {{ \Carbon\Carbon::parse($laporan->tanggal_selesai)->format('d F Y H:i') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Bidang -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Bidang Terkait</p>
                            <p class="text-sm text-gray-600">{{ $laporan->bidang->nama ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Pelapor -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Pelapor</p>
                            <p class="text-sm text-gray-600">
                                {{ $laporan->is_anonim ? 'Anonim' : $laporan->nama_pelapor }}
                            </p>
                            @unless ($laporan->is_anonim)
                                @if ($laporan->kontak_pelapor)
                                    <p class="text-xs text-gray-500 mt-1">Kontak: {{ $laporan->kontak_pelapor }}</p>
                                @endif
                            @endunless
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Laporan -->
            <div>
                <p class="text-sm font-medium text-gray-900 mb-2">Foto Laporan</p>
                <div class="bg-gray-100 rounded-lg overflow-hidden">
                    @if ($laporan->foto)
                        <img src="{{ Storage::url($laporan->foto) }}" alt="Foto Laporan" class="w-full h-48 object-cover">
                    @else
                        <p class="text-sm text-gray-500 p-4">Tidak ada foto</p>
                    @endif
                </div>
                @if ($laporan->lampiran && $laporan->lampiran->count())
                    <p class="text-sm font-medium text-gray-900 mt-4 mb-2">Lampiran Tambahan</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach ($laporan->lampiran as $file)
                            <a href="{{ $file->url ?? Storage::url($file->path) }}" target="_blank" rel="noopener"
                                class="block group">
                                <div class="aspect-video bg-gray-100 rounded overflow-hidden">
                                    <img src="{{ $file->url ?? Storage::url($file->path) }}"
                                        class="w-full h-full object-cover group-hover:opacity-90 transition">
                                </div>
                                <span class="sr-only">Buka lampiran</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <p class="text-sm font-medium text-gray-900 mb-2">Deskripsi</p>
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $laporan->deskripsi }}
            </p>
        </div>

        <!-- Progress -->
        <div class="mb-6">
            <p class="text-sm font-medium text-gray-900 mb-3">Progress Penanganan</p>
            <div class="mb-2 flex items-center justify-between text-xs text-gray-500">
                <span>{{ $progress }}%</span>
                <span>
                    {{ ucfirst($laporan->status_verifikasi) }}
                    @if ($laporan->status_verifikasi === 'diterima')
                        — {{ ucfirst($laporan->status_penanganan) }}
                    @endif
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ $progress }}%">
                </div>
            </div>
        </div>

        <!-- Aksi -->
        <div class="flex items-center justify-end mt-6 space-x-3">
            <form action="{{ route('warga.laporan.destroy', $laporan->id) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium rounded-md bg-red-600 text-white hover:bg-red-700">
                    Hapus Laporan
                </button>
            </form>
        </div>
    </div>
@endsection
