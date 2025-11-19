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
                                <p class="text-gray-500">Kontak</p>
                                <p class="text-gray-900 font-medium">{{ $lap->kontak_pelapor }}</p>
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

                <!-- Kolom kanan: Info Tim + Review + WA -->
                <div>
                    {{-- Informasi Tim --}}
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

                    {{-- Hasil Review (kalau ada) --}}
                    @if (isset($laporanTugas->status_review, $laporanTugas->rating_review, $laporanTugas->catatan_review))
                        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Hasil Review</h3>
                            <p class="text-sm">
                                <span class="text-gray-500">Status:</span>
                                <b>{{ ucfirst($laporanTugas->status_review) }}</b>
                            </p>
                            <p class="text-sm mt-1">
                                <span class="text-gray-500">Rating:</span>
                                <b>{{ $laporanTugas->rating_review }}/5</b>
                            </p>
                            @if ($laporanTugas->catatan_review)
                                <p class="text-sm text-gray-700 mt-2">{{ $laporanTugas->catatan_review }}</p>
                            @endif
                        </div>
                    @endif

                    {{-- 🔔 Tombol kirim status via WhatsApp ke pelapor --}}
                    @if ($lap && !empty($lap->kontak_pelapor))
                        @php
                            // pastikan status_penanganan aman untuk dicek
                            $statusPenanganan = strtolower(trim($lap->status_penanganan ?? ''));
                        @endphp

                        @if ($statusPenanganan === 'selesai')
                            @php
                                // Normalisasi nomor WA (ambil digit saja)
                                $rawPhone = preg_replace('/[^0-9]/', '', $lap->kontak_pelapor);

                                if (\Illuminate\Support\Str::startsWith($rawPhone, '0')) {
                                    $waNumber = '62' . substr($rawPhone, 1);
                                } elseif (\Illuminate\Support\Str::startsWith($rawPhone, '62')) {
                                    $waNumber = $rawPhone;
                                } else {
                                    $waNumber = $rawPhone; // fallback apa adanya
                                }

                                // Tanggal selesai
                                $tanggalSelesaiText = $lap->tanggal_selesai
                                    ? \Illuminate\Support\Carbon::parse($lap->tanggal_selesai)->format('d-m-Y')
                                    : '-';

                                // Anggaran & sumber
                                $anggaranText = $laporanTugas->anggaran
                                    ? 'Rp ' . number_format($laporanTugas->anggaran, 2, ',', '.')
                                    : '-';

                                $sumberAnggaranText = $laporanTugas->sumber_anggaran ?? '-';
                                $catatanAnggaranText = $laporanTugas->catatan_anggaran ?? '-';

                                // Nama pelapor
                                $namaPelapor = $lap->nama_pelapor ?: 'Bapak/Ibu';

                                // Susun pesan WA
                                $waMessage = "Yth. {$namaPelapor},\n\n";
                                $waMessage .= "Laporan Anda telah *SELESAI* ditangani oleh Dinas Pekerjaan Umum.\n\n";
                                $waMessage .= "*Rincian Laporan:*\n";
                                $waMessage .= "- Kode: {$lap->kode_laporan}\n";
                                $waMessage .= "- Judul: {$lap->judul}\n";
                                $waMessage .= "- Alamat: {$lap->alamat}\n";
                                $waMessage .= '- Status Verifikasi: ' . ucfirst($lap->status_verifikasi) . "\n";
                                $waMessage .= '- Status Penanganan: ' . ucfirst($lap->status_penanganan) . "\n";
                                $waMessage .= "- Tanggal Selesai: {$tanggalSelesaiText}\n\n";

                                $waMessage .= "*Rincian Penugasan:*\n";
                                $waMessage .= '- Tim: ' . ($team->nama_tim ?? '-') . "\n";
                                $waMessage .= '- Penanggung Jawab: ' . ($pj->name ?? '-') . "\n\n";

                                $waMessage .= "*Anggaran:*\n";
                                $waMessage .= "- Nilai Anggaran: {$anggaranText}\n";
                                $waMessage .= "- Sumber Anggaran: {$sumberAnggaranText}\n";
                                if (!empty($laporanTugas->catatan_anggaran)) {
                                    $waMessage .= "- Catatan: {$catatanAnggaranText}\n";
                                }

                                $waMessage .=
                                    "\nTerima kasih atas partisipasi Anda dalam melaporkan masalah infrastruktur.\n\n";
                                $waMessage .=
                                    "Mohon kesediaannya untuk mengisi *saran/feedback* terkait penanganan laporan ini melalui tautan berikut:\n";
                                $waMessage .= route('saran.index') . "\n\n";
                                $waMessage .= "Salam hormat,\nDinas Pekerjaan Umum";

                                $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($waMessage);
                            @endphp

                            <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mt-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Kirim Status ke Pelapor</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Nomor pelapor:
                                    <span class="font-medium">{{ $lap->kontak_pelapor }}</span><br>
                                    Pesan WhatsApp akan berisi ringkasan laporan, status penyelesaian, anggaran, serta
                                    tautan
                                    untuk mengisi saran.
                                </p>
                                <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                                    class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M20.52 3.48A11.76 11.76 0 0012 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.26-1.62A11.76 11.76 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22a9.83 9.83 0 01-5-1.35l-.36-.21-3.71.96.99-3.61-.23-.37A9.83 9.83 0 012 12C2 6.48 6.48 2 12 2c2.64 0 5.14 1.03 7.03 2.92A9.9 9.9 0 0122 12c0 5.52-4.48 10-10 10zm5.06-7.69c-.27-.13-1.61-.79-1.86-.88-.25-.09-.43-.13-.61.13-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.13-1.14-.42-2.17-1.33-.8-.71-1.33-1.59-1.48-1.86-.16-.27-.02-.42.12-.55.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.13-.61-1.47-.83-2.02-.22-.52-.44-.45-.61-.46h-.52c-.18 0-.48.07-.73.34-.25.27-.95.93-.95 2.26s.97 2.63 1.1 2.81c.14.18 1.91 2.91 4.63 4.08.65.28 1.16.45 1.56.57.65.21 1.24.18 1.71.11.52-.08 1.61-.66 1.84-1.3.23-.64.23-1.19.16-1.3-.07-.11-.25-.18-.52-.3z" />
                                    </svg>
                                    Kirim WhatsApp ke Pelapor
                                </a>
                            </div>
                        @endif
                    @endif
                </div>


            </div>
        </div>
    </div>
@endsection
