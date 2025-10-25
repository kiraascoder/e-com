{{-- resources/views/laporan/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    {{-- Leaflet CSS (untuk peta) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            width: 100%;
            height: 320px;
            /* tinggi default */
            border-radius: 0.75rem;
            /* rounded-lg */
            overflow: hidden;
        }

        @media (min-width: 1024px) {

            /* lg */
            #map {
                height: 420px;
            }
        }

        .leaflet-container {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- Header --}}
        <div class="flex items-start justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $laporan->judul ?? '—' }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kode: {{ $laporan->kode_laporan ?? '—' }} |
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
                    // mapping kalau pakai lowercase dari model:
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'ditolak' => 'bg-red-100 text-red-800',
                    'diterima' => 'bg-green-100 text-green-800',
                ];
                $badgeClass = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }} capitalize">
                {{ is_string($status) ? $status : '—' }}
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
                        use Illuminate\Support\Facades\Storage;
                        $fotoPath = $laporan->foto ?? null;
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

                {{-- Peta Lokasi (Leaflet) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-base font-semibold text-gray-900">Peta Lokasi</h2>
                        <div class="flex items-center gap-2">
                            @php
                                $lat = $laporan->latitude;
                                $lng = $laporan->longitude;
                                $hasCoord = filled($lat) && filled($lng);
                            @endphp

                            <button type="button" id="btn-copy-koordinat"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 text-xs font-medium disabled:opacity-50"
                                {{ $hasCoord ? '' : 'disabled' }} data-lat="{{ $lat }}"
                                data-lng="{{ $lng }}" title="Salin koordinat">
                                Salin Koordinat
                            </button>

                            <a href="{{ $hasCoord ? 'https://www.google.com/maps?q=' . $lat . ',' . $lng : '#' }}"
                                target="_blank"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 text-xs font-medium {{ $hasCoord ? '' : 'pointer-events-none opacity-50' }}"
                                title="Buka di Google Maps">
                                Buka Google Maps
                            </a>
                        </div>
                    </div>

                    @if ($hasCoord)
                        <div class="text-sm text-gray-700 mb-3">
                            <span class="text-gray-500">Koordinat:</span>
                            <span class="font-medium">
                                {{ number_format((float) $lat, 6, '.', '') }},
                                {{ number_format((float) $lng, 6, '.', '') }}
                            </span>
                        </div>
                        <div id="map" aria-label="Peta lokasi laporan"></div>
                    @else
                        <p class="text-sm text-gray-500">Koordinat belum tersedia. Pastikan <span
                                class="font-medium">latitude</span> dan <span class="font-medium">longitude</span> diisi
                            pada data laporan.</p>
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
                            <span class="text-gray-500">Kecamatan:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->kecamatan ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Kelurahan:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->kelurahan ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Bidang:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->bidang?->nama ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Kategori:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->kategori_fasilitas ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Jenis Kerusakan:</span>
                            <span class="font-medium text-gray-900">{{ $laporan->jenis_kerusakan ?? '—' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-gray-500">Tanggal Laporan:</span>
                            <span class="font-medium text-gray-900">
                                {{ $laporan->tanggal_laporan?->format('d M Y') ?? ($laporan->tanggal_laporan ? \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d M Y') : '—') }}
                            </span>
                        </p>

                        <div class="grid grid-cols-2 gap-2 pt-2">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-xs text-gray-500">Latitude</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ filled($laporan->latitude) ? number_format((float) $laporan->latitude, 6, '.', '') : '—' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-xs text-gray-500">Longitude</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ filled($laporan->longitude) ? number_format((float) $laporan->longitude, 6, '.', '') : '—' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Status Penanganan</h2>
                    <div class="flex items-center gap-2">
                        @php
                            $penanganan = $laporan->status_penanganan ?? 'menunggu';
                            $penangananClasses = [
                                'menunggu' => 'bg-gray-100 text-gray-800',
                                'diproses' => 'bg-blue-100 text-blue-800',
                                'selesai' => 'bg-green-100 text-green-800',
                                'ditunda' => 'bg-yellow-100 text-yellow-800',
                            ];
                            $penangananBadge = $penangananClasses[$penanganan] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $penangananBadge }} capitalize">
                            {{ $penanganan }}
                        </span>
                        @if ($laporan->tanggal_selesai)
                            <span class="text-xs text-gray-500">
                                (Selesai: {{ \Carbon\Carbon::parse($laporan->tanggal_selesai)->format('d M Y') }})
                            </span>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Aksi</h2>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex items-center px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-sm font-medium">
                            Kembali
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Leaflet JS (untuk peta) --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        (function() {
            const hasMap = document.getElementById('map');
            @if (filled($laporan->latitude) && filled($laporan->longitude))
                if (hasMap) {
                    const lat = {{ (float) $laporan->latitude }};
                    const lng = {{ (float) $laporan->longitude }};
                    const title = @json($laporan->judul ?? 'Lokasi Laporan');

                    const map = L.map('map', {
                        zoomControl: true
                    }).setView([lat, lng], 17);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 20,
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a>'
                    }).addTo(map);

                    const marker = L.marker([lat, lng]).addTo(map);
                    marker.bindPopup(`<strong>${title}</strong><br>Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`)
                        .openPopup();

                    // salin koordinat
                    const btnCopy = document.getElementById('btn-copy-koordinat');
                    if (btnCopy) {
                        btnCopy.addEventListener('click', async () => {
                            const text = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                            try {
                                await navigator.clipboard.writeText(text);
                                btnCopy.textContent = 'Disalin!';
                                setTimeout(() => btnCopy.textContent = 'Salin Koordinat', 1200);
                            } catch (e) {
                                alert('Gagal menyalin koordinat');
                            }
                        });
                    }
                }
            @endif
        })();
    </script>
@endpush
