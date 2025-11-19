@extends('layouts.app')

@section('title', 'Saran Warga - Dinas')

@section('content')
    @include('partials.dashboard-header', [
        'greeting' => 'Saran & Feedback Warga',
        'roleTitle' => 'Kepala Dinas',
        'description' => 'Pantau saran masyarakat sebagai bahan evaluasi pelayanan dan infrastruktur.',
        'bgGradient' => 'from-blue-600 to-blue-800',
        'badgeText' => 'Kepala Dinas',
        'roleIcon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>',
    ])

    @include('partials.flash')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Filter & Info -->
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Daftar Saran Warga</h2>
                <p class="text-sm text-gray-600">
                    Gunakan saran sebagai masukan untuk peningkatan pelayanan Dinas PU.
                </p>
            </div>

            <form method="GET" class="flex flex-wrap gap-3 items-center">
                <select name="kategori" class="text-sm rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    <option value="pelayanan" @selected(request('kategori') == 'pelayanan')>Pelayanan</option>
                    <option value="infrastruktur" @selected(request('kategori') == 'infrastruktur')>Infrastruktur</option>
                    <option value="sistem" @selected(request('kategori') == 'sistem')>Sistem Aplikasi</option>
                    <option value="lainnya" @selected(request('kategori') == 'lainnya')>Lainnya</option>
                </select>

                <select name="status" class="text-sm rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="baru" @selected(request('status') == 'baru')>Baru</option>
                    <option value="diproses" @selected(request('status') == 'diproses')>Diproses</option>
                    <option value="selesai" @selected(request('status') == 'selesai')>Selesai</option>
                </select>

                <button type="submit"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md bg-blue-600 text-white hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        @if ($sarans->count() === 0)
            <div class="bg-white rounded-xl shadow-sm p-6 text-center text-gray-500">
                Belum ada saran yang masuk.
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach ($sarans as $saran)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col justify-between">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-gray-900 mb-1">
                                    {{ $saran->judul }}
                                </h3>
                                <p class="text-xs text-gray-500 mb-2">
                                    {{ $saran->created_at->format('d M Y H:i') }}
                                    @if ($saran->nama)
                                        • oleh <span class="font-medium">{{ $saran->nama }}</span>
                                    @else
                                        • <span class="italic">Anonim</span>
                                    @endif
                                </p>

                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    {{-- Kategori --}}
                                    @if ($saran->kategori)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                   @if ($saran->kategori === 'pelayanan') bg-blue-100 text-blue-700
                                                   @elseif($saran->kategori === 'infrastruktur') bg-green-100 text-green-700
                                                   @elseif($saran->kategori === 'sistem') bg-purple-100 text-purple-700
                                                   @else bg-gray-100 text-gray-700 @endif">
                                            {{ ucfirst($saran->kategori) }}
                                        </span>
                                    @endif

                                    {{-- Status --}}
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                               @if ($saran->status_tindak_lanjut === 'baru') bg-red-100 text-red-700
                                               @elseif($saran->status_tindak_lanjut === 'diproses') bg-yellow-100 text-yellow-700
                                               @else bg-green-100 text-green-700 @endif">
                                        {{ ucfirst($saran->status_tindak_lanjut) }}
                                    </span>

                                    {{-- Kepuasan --}}
                                    @if ($saran->kepuasan)
                                        <span class="inline-flex items-center text-xs text-gray-600">
                                            ⭐ <span class="ml-1">{{ $saran->kepuasan }}/5</span>
                                        </span>
                                    @endif
                                </div>

                                <p class="text-sm text-gray-700 line-clamp-3">
                                    {{ $saran->isi_saran }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="text-xs text-gray-500">
                                @if ($saran->follow_up)
                                    <span class="inline-flex items-center">
                                        <span class="w-2 h-2 rounded-full bg-blue-500 mr-1.5"></span>
                                        Meminta tindak lanjut
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('dinas.saran.show', $saran) }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                                Lihat Detail &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $sarans->links() }}
            </div>
        @endif
    </div>
@endsection
