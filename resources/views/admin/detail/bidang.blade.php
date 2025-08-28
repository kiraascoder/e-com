@extends('layouts.app')

@section('title', 'Detail Bidang')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm mb-1">Detail Bidang</p>
                    <h1 class="text-2xl font-bold">{{ $bidang->nama }}</h1>
                    <p class="mt-1 text-blue-100">
                        Atur informasi, ketua, tim rutin, dan laporan yang terkait dengan bidang ini.
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.bidang') }}"
                        class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Info Ringkas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kartu Info Utama -->
            <div class="col-span-1 md:col-span-3 bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Nama Bidang</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $bidang->nama }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Ketua</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $bidang->ketua?->name ?? 'Belum ada ketua' }}
                            </p>
                        </div>
                        <div class="flex items-end gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500">Total Tim Rutin</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $bidang->timRutins->count() }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500">Total Laporan</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $bidang->laporans->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-2">
                        @if ($bidang->ketua)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-green-100 text-green-800">
                                Memiliki Ketua
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-red-100 text-red-800">
                                Belum Memiliki Ketua
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Tim Rutin -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Tim Rutin</h2>
                    <p class="text-sm text-gray-500">Tim yang berada di bawah bidang ini.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Tim</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bidang->timRutins as $tim)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $tim->nama_tim ?? ($tim->nama ?? '—') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700 line-clamp-2">
                                        {{ $tim->deskripsi ?? '—' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-3">
                                        <a href=""
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detail</a>
                                        <a href=""
                                            class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-sm text-gray-500">
                                    Belum ada Tim Rutin pada bidang ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daftar Laporan -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Laporan</h2>
                <p class="text-sm text-gray-500">Laporan yang terkait dengan bidang ini.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bidang->laporans as $lap)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $lap->judul ?? ($lap->judul_laporan ?? '—') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700">
                                        {{ \Illuminate\Support\Carbon::parse($lap->created_at ?? ($lap->tanggal_laporan ?? now()))->translatedFormat('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $status = $lap->status ?? ($lap->status_laporan ?? '—');
                                        $map = [
                                            'Draft' => 'bg-gray-100 text-gray-800',
                                            'Submitted' => 'bg-blue-100 text-blue-800',
                                            'Reviewed' => 'bg-yellow-100 text-yellow-800',
                                            'Approved' => 'bg-green-100 text-green-800',
                                        ];
                                        $cls = $map[$status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $cls }}">{{ $status }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-3">
                                        <a href=""
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detail</a>
                                        <a href=""
                                            class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500">
                                    Belum ada laporan pada bidang ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-white rounded-lg shadow border border-red-200">
            <div class="px-6 py-4 border-b border-red-100">
                <h2 class="text-lg font-semibold text-red-700">Danger Zone</h2>
                <p class="text-sm text-red-600">Aksi sensitif untuk bidang ini.</p>
            </div>
            <div class="p-6 flex flex-wrap gap-3">
                <form action="{{ route('admin.bidang.delete', $bidang->id) }}" method="POST"
                    onsubmit="return confirm('Hapus bidang ini? Aksi tidak bisa dibatalkan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium">
                        Hapus Bidang
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
