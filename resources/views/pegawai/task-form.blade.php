@extends('layouts.app')

@section('title', 'Submit Laporan Tugas')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Submit Laporan Tugas</h1>
                    <p class="mt-1 text-blue-100">
                        Tim: <b>{{ $timNonRutin->nama_tim }}</b> • PJ:
                        <b>{{ $timNonRutin->penanggungJawab->name ?? '—' }}</b>
                    </p>
                    <p class="text-blue-100">
                        Laporan: [{{ $laporan->kode_laporan ?? 'KODE' }}] {{ $laporan->judul }}
                    </p>
                </div>
                <a href="{{ url()->previous() }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Alerts --}}
        @if (session('success'))
            <div class="mb-6 p-3 rounded-md bg-green-100 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 p-3 rounded-md bg-red-100 border border-red-200 text-red-800">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200 text-red-800">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Ringkasan Laporan yang Ditangani --}}
        @php
            $badgeVerif = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'diterima' => 'bg-blue-100 text-blue-800',
                'ditolak' => 'bg-red-100 text-red-800',
            ];
            $badgeProc = [
                'menunggu' => 'bg-gray-100 text-gray-800',
                'diproses' => 'bg-indigo-100 text-indigo-800',
                'ditunda' => 'bg-orange-100 text-orange-800',
                'selesai' => 'bg-green-100 text-green-800',
            ];
        @endphp

        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-500">Laporan Ditangani</p>
                    <p class="text-base font-semibold text-gray-900">
                        [{{ $laporan->kode_laporan ?? 'KODE' }}] {{ $laporan->judul }}
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        {{ $laporan->alamat }}
                    </p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span
                            class="px-2 py-1 text-xs rounded-full {{ $badgeVerif[$laporan->status_verifikasi] ?? 'bg-gray-100 text-gray-800' }}">
                            Verifikasi: {{ ucfirst($laporan->status_verifikasi) }}
                        </span>
                        <span
                            class="px-2 py-1 text-xs rounded-full {{ $badgeProc[$laporan->status_penanganan] ?? 'bg-gray-100 text-gray-800' }}">
                            Status: {{ ucfirst($laporan->status_penanganan) }}
                        </span>
                        @if ($laporan->tanggal_selesai)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-50 text-green-700 border border-green-100">
                                Selesai:
                                {{ \Illuminate\Support\Carbon::parse($laporan->tanggal_selesai)->format('d M Y') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('pegawai.laporan.show', $laporan->id) }}"
                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Detail Laporan</a>
                </div>
            </div>
            <p class="mt-4 text-xs text-gray-500">
                Catatan: Laporan tugas hanya dapat disubmit jika laporan warga sudah <b>DITERIMA</b> dan <b>SELESAI</b>.
                Kolom penanggung jawab & referensi laporan ditetapkan otomatis oleh sistem.
            </p>
        </div>

        {{-- Form Submit Laporan Tugas --}}
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <form action="{{ route('pegawai.laporan-tugas.store', $timNonRutin) }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') ?? now()->toDateString() }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                    @error('tanggal')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pekerjaan <span
                            class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Uraikan hasil kerja, bahan/alat yang digunakan, kendala di lapangan, dsb.">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Anggaran (Rp)</label>
                        <input type="number" step="0.01" min="0" name="anggaran" value="{{ old('anggaran') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        @error('anggaran')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Anggaran</label>

                        <select name="sumber_anggaran"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Sumber Anggaran --</option>
                            <option value="pusat" {{ old('sumber_anggaran') == 'pusat' ? 'selected' : '' }}>
                                Anggaran Pusat
                            </option>
                            <option value="daerah" {{ old('sumber_anggaran') == 'daerah' ? 'selected' : '' }}>
                                Anggaran Daerah
                            </option>
                        </select>

                        @error('sumber_anggaran')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Anggaran</label>
                    <textarea name="catatan_anggaran" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Rincian penggunaan/justifikasi (opsional)">{{ old('catatan_anggaran') }}</textarea>
                    @error('catatan_anggaran')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </a>

                    @php
                        $eligible =
                            $laporan->status_verifikasi === 'diterima' && $laporan->status_penanganan === 'selesai';
                    @endphp

                    <button type="submit"
                        class="px-4 py-2 rounded-md text-white {{ $eligible ? 'bg-blue-600 hover:bg-blue-700' : 'bg-gray-300 cursor-not-allowed' }}"
                        {{ $eligible ? '' : 'disabled' }}>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
