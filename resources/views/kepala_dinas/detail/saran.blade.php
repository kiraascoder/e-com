@extends('layouts.app')

@section('title', 'Detail Saran Warga')

@section('content')
    @include('partials.dashboard-header', [
        'greeting' => 'Detail Saran Warga',
        'roleTitle' => 'Kepala Dinas',
        'description' => 'Tinjau isi saran dan tentukan tindak lanjut yang diperlukan.',
        'bgGradient' => 'from-blue-600 to-blue-800',
        'badgeText' => 'Kepala Dinas',
        'roleIcon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>',
    ])

    @include('partials.flash')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-4">
            <a href="{{ route('dinas.saran') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                &larr; Kembali ke daftar saran
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">
                        {{ $saran->judul }}
                    </h1>
                    <p class="text-sm text-gray-500">
                        Dikirim pada {{ $saran->created_at->format('d M Y H:i') }}
                        @if ($saran->nama)
                            • oleh <span class="font-medium">{{ $saran->nama }}</span>
                        @else
                            • <span class="italic">Anonim</span>
                        @endif
                        @if ($saran->kontak)
                            • Kontak: <span class="font-medium">{{ $saran->kontak }}</span>
                        @endif
                    </p>
                </div>

                <div class="flex flex-col items-start gap-2">
                    <div class="flex flex-wrap gap-2">
                        @if ($saran->kategori)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                       @if ($saran->kategori === 'pelayanan') bg-blue-100 text-blue-700
                                       @elseif($saran->kategori === 'infrastruktur') bg-green-100 text-green-700
                                       @elseif($saran->kategori === 'sistem') bg-purple-100 text-purple-700
                                       @else bg-gray-100 text-gray-700 @endif">
                                Kategori: {{ ucfirst($saran->kategori) }}
                            </span>
                        @endif

                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                   @if ($saran->status_tindak_lanjut === 'baru') bg-red-100 text-red-700
                                   @elseif($saran->status_tindak_lanjut === 'diproses') bg-yellow-100 text-yellow-700
                                   @else bg-green-100 text-green-700 @endif">
                            Status: {{ ucfirst($saran->status_tindak_lanjut) }}
                        </span>
                    </div>

                    @if ($saran->kepuasan)
                        <div class="text-sm text-gray-700">
                            Tingkat Kepuasan:
                            <span class="font-semibold">⭐ {{ $saran->kepuasan }}/5</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-2">Isi Saran</h2>
                <p class="text-sm text-gray-800 whitespace-pre-line leading-relaxed">
                    {{ $saran->isi_saran }}
                </p>
            </div>

            <div class="mt-6 border-t border-gray-100 pt-4 flex flex-col gap-2 text-sm text-gray-600">
                @if ($saran->follow_up)
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        Warga <span class="font-medium">bersedia dihubungi</span> terkait saran ini.
                    </div>
                @endif

                @if ($saran->ditindaklanjuti_pada)
                    <div>
                        Ditindaklanjuti pada:
                        <span class="font-medium">
                            {{ $saran->ditindaklanjuti_pada->format('d M Y H:i') }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
