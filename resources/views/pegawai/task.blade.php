@extends('layouts.app')

@section('title', 'Laporan Tugas — Siap Disubmit')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Laporan Tugas</h1>
                    <p class="mt-1 text-blue-100">
                        Daftar tim & laporan yang Anda tangani. Submit laporan tugas setelah pekerjaan selesai.
                    </p>
                </div>
                <a href="{{ route('pegawai.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Flash messages --}}
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

        @php
            // Terima $timNonRutins atau $tims dari controller
            $teams = $timNonRutins ?? ($tims ?? collect());

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

        @if ($teams->isEmpty())
            <div class="bg-white rounded-lg border border-gray-200 p-8 text-center text-gray-600">
                Belum ada tim / laporan yang siap disubmit.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($teams as $team)
                    @php
                        // Relasi yang diharapkan: $team->laporan, $team->laporanNonRutin, $team->penanggungJawab
                        $lap = $team->laporan ?? null;
                        $alreadySubmitted = !empty($team->laporanNonRutin); // butuh with('laporanNonRutin') di controller
                        $eligible =
                            $lap && $lap->status_verifikasi === 'diterima' && $lap->status_penanganan === 'selesai';
                    @endphp

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-5 flex flex-col">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $team->nama_tim ?? 'Tim Non Rutin' }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    PJ: {{ optional($team->penanggungJawab)->name ?? '—' }}
                                </p>
                            </div>
                            {{-- Status penanganan laporan --}}
                            @if ($lap)
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $badgeProc[$lap->status_penanganan] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($lap->status_penanganan) }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 space-y-2 text-sm">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mt-0.5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6M7 8h10M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                </svg>
                                <div>
                                    <p class="text-gray-900 font-medium">Laporan Ditangani</p>
                                    @if ($lap)
                                        <p class="text-gray-700">
                                            [{{ $lap->kode_laporan ?? 'KODE' }}] {{ $lap->judul }}
                                        </p>
                                        <div class="mt-1 flex flex-wrap gap-2">
                                            <span
                                                class="px-2 py-0.5 text-xs rounded-full {{ $badgeVerif[$lap->status_verifikasi] ?? 'bg-gray-100 text-gray-800' }}">
                                                Verifikasi: {{ ucfirst($lap->status_verifikasi) }}
                                            </span>
                                            @if ($lap->tanggal_selesai)
                                                <span
                                                    class="px-2 py-0.5 text-xs rounded-full bg-green-50 text-green-700 border border-green-100">
                                                    Selesai:
                                                    {{ \Illuminate\Support\Carbon::parse($lap->tanggal_selesai)->format('d M Y') }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-gray-500">Belum terhubung ke laporan warga.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                @if ($lap)
                                    <a href="{{ route('pegawai.laporan.show', $lap->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Detail Laporan
                                    </a>
                                @endif
                            </div>

                            {{-- Aksi submit Laporan Tugas --}}
                            @if ($alreadySubmitted)
                                <span
                                    class="px-3 py-2 text-xs font-semibold rounded-md bg-green-100 text-green-800 border border-green-200">
                                    Sudah Disubmit
                                </span>
                            @elseif ($eligible)
                                {{-- Jika pakai route model binding untuk TimNonRutin --}}
                                <a href="{{ route('pegawai.laporan-tugas.create', $team) }}"
                                    class="px-4 py-2 text-sm font-medium rounded-md bg-blue-600 text-white hover:bg-blue-700">
                                    Submit Laporan Tugas
                                </a>
                            @else
                                <button type="button"
                                    class="px-4 py-2 text-sm font-medium rounded-md bg-gray-200 text-gray-600 cursor-not-allowed"
                                    title="Laporan harus DITERIMA dan SELESAI sebelum submit">
                                    Submit Laporan Tugas
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
