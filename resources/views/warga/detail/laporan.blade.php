@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="max-w-5xl mx-auto p-5 bg-white rounded-md shadow mt-6">
        <!-- Header -->
        <div class="flex items-center justify-between pb-4 border-b">
            <h3 class="text-2xl font-semibold text-gray-900">Detail Laporan</h3>
            <a href="{{ route('warga.laporan') }}" class="text-gray-400 hover:text-gray-600 transition duration-300">
                ← Kembali
            </a>
        </div>

        <!-- Status Badge -->
        @php
            $statusColors = [
                'pending' => 'bg-blue-100 text-blue-800',
                'diterima' => 'bg-yellow-100 text-yellow-800',
                'selesai' => 'bg-green-100 text-green-800',
                'ditolak' => 'bg-red-100 text-red-800',
            ];
            $status = strtolower($laporan->status_verifikasi ?? 'pending');
        @endphp

        <div class="mt-4 mb-4">
            <span
                class="px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst($status) }}
            </span>
        </div>


        <!-- Laporan Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ $laporan->judul }}
                </h4>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Alamat</p>
                            <p class="text-sm text-gray-600">{{ $laporan->alamat }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z">
                            </path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Tanggal Lapor</p>
                            <p class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Pelapor</p>
                            <p class="text-sm text-gray-600">{{ $laporan->nama_pelapor }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Laporan -->
            <div>
                <p class="text-sm font-medium text-gray-900 mb-2">Foto Laporan</p>
                <div class="bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/' . $laporan->foto) }}" alt="Foto Laporan" class="w-full h-48 object-cover">
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <p class="text-sm font-medium text-gray-900 mb-2">Deskripsi</p>
            <p class="text-sm text-gray-600 leading-relaxed">
                {{ $laporan->deskripsi }}
            </p>
        </div>

        <!-- Progress Timeline -->
        <div class="mb-6">
            <p class="text-sm font-medium text-gray-900 mb-4">Timeline Progress</p>
            @php
                $progressMap = [
                    'pending' => 25,
                    'diterima' => 60,
                    'selesai' => 100,
                    'ditolak' => 0,
                ];
                $progress = $progressMap[$laporan->status_verifikasi] ?? 0;
            @endphp

            <div class="mb-4">
                <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                    <span>Progress</span>
                    <span>{{ $progress }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                        style="width: {{ $progress }}%"></div>
                </div>
            </div>

            {{-- <div class="space-y-4">
                @foreach ($laporan->timeline as $step)
                    <div class="flex items-start">
                        <div class="w-3 h-3 mt-1 rounded-full bg-blue-600 mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $step['judul'] }}</p>
                            <p class="text-xs text-gray-500">{{ $step['tanggal'] }}</p>
                            <p class="text-sm text-gray-600">{{ $step['keterangan'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div> --}}
        </div>

        <!-- Keterangan dari Petugas -->
        {{-- <div class="mb-6 bg-gray-50 rounded-lg p-4">
            <p class="text-sm font-medium text-gray-900 mb-2">Keterangan dari Petugas</p>
            <p class="text-sm text-gray-600">{{ $laporan->keterangan_petugas }}</p>
            <p class="text-xs text-gray-500 mt-2">
                Petugas: {{ $laporan->petugas }} - {{ $laporan->tanggal_keterangan->format('d F Y') }}
            </p>
        </div> --}}        
    </div>
@endsection
