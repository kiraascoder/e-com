@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm mb-1">Detail User</p>
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="mt-1 text-blue-100">Informasi profil dan keterkaitan user dalam sistem</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.users') }}"
                        class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">←
                        Kembali</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Hapus user ini? Aksi tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Profil Ringkas -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Nama</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Email</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Role</p>
                        @php
                            $role = $user->role ?? 'User';
                            $map = [
                                'Admin' => 'bg-red-100 text-red-800',
                                'Ketua Bidang' => 'bg-blue-100 text-blue-800',
                                'Pegawai' => 'bg-green-100 text-green-800',
                                'Warga' => 'bg-gray-100 text-gray-800',
                            ];
                            $cls = $map[$role] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $cls }}">
                            {{ $role }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">No. Telepon</p>
                        <p class="text-base text-gray-900">{{ $user->no_telepon ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Jenis Kelamin</p>
                        <p class="text-base text-gray-900">{{ $user->jenis_kelamin ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Tanggal Lahir</p>
                        <p class="text-base text-gray-900">
                            @if ($user->tanggal_lahir)
                                {{ \Illuminate\Support\Carbon::parse($user->tanggal_lahir)->translatedFormat('d M Y') }}
                            @else
                                —
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Alamat</p>
                        <p class="text-base text-gray-900">{{ $user->alamat ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bidang yang Dipimpin (jika Ketua Bidang) -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Bidang yang Dipimpin</h2>
                    <p class="text-sm text-gray-500">Menampilkan bidang jika user berperan sebagai Ketua Bidang.</p>
                </div>
            </div>
            <div class="p-6">
                @if ($user->bidangKetua)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-semibold text-gray-900">{{ $user->bidangKetua->nama }}</p>
                            <p class="text-sm text-gray-600">Ketua sejak:
                                {{ optional($user->bidangKetua->created_at)->translatedFormat('d M Y') ?? '—' }}
                            </p>
                        </div>
                        <a href="{{ route('admin.bidang.show', $user->bidangKetua->id) }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Bidang</a>
                    </div>
                @else
                    <p class="text-sm text-gray-500">Tidak memimpin bidang mana pun.</p>
                @endif
            </div>
        </div>

        <!-- Tim Rutin yang Dipegang -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Penanggung Jawab Tim Rutin</h2>
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
                        @forelse ($user->timRutinDipegang as $tim)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $tim->nama_tim ?? ($tim->nama ?? '—') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $tim->deskripsi ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.tim-rutin.show', $tim->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-sm text-gray-500">Tidak ada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tim Non Rutin yang Dipegang -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Penanggung Jawab Tim Non-Rutin</h2>
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
                        @forelse ($user->timNonRutinDipegang as $tim)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $tim->nama_tim ?? ($tim->nama ?? '—') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $tim->deskripsi ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.nonrutin.show', $tim->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-sm text-gray-500">Tidak ada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tim yang Diikuti (Many-to-Many) -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Keanggotaan Tim</h2>
                <p class="text-sm text-gray-500">Tim Rutin & Non-Rutin dimana user terdaftar sebagai anggota.</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800 mb-2">Tim Rutin</h3>
                        <ul class="space-y-2">
                            @forelse ($user->timRutin as $tim)
                                <li class="flex items-center justify-between bg-gray-50 rounded-md px-3 py-2">
                                    <span class="text-sm text-gray-800">{{ $tim->nama_tim ?? ($tim->nama ?? '—') }}</span>
                                    <a href="{{ route('admin.tim-rutin.show', $tim->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-xs font-medium">Detail</a>
                                </li>
                            @empty
                                <li class="text-sm text-gray-500">Tidak ada.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800 mb-2">Tim Non-Rutin</h3>
                        <ul class="space-y-2">
                            @forelse ($user->timNonRutin as $tim)
                                <li class="flex items-center justify-between bg-gray-50 rounded-md px-3 py-2">
                                    <span class="text-sm text-gray-800">{{ $tim->nama_tim ?? ($tim->nama ?? '—') }}</span>
                                    <a href="{{ route('admin.nonrutin.show', $tim->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-xs font-medium">Detail</a>
                                </li>
                            @empty
                                <li class="text-sm text-gray-500">Tidak ada.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan yang Dibuat -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Laporan Dibuat</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($user->laporanDibuat as $lap)
                            @php
                                $status = $lap->status ?? ($lap->status_laporan ?? '—');
                                $badge =
                                    [
                                        'Draft' => 'bg-gray-100 text-gray-800',
                                        'Submitted' => 'bg-blue-100 text-blue-800',
                                        'Reviewed' => 'bg-yellow-100 text-yellow-800',
                                        'Approved' => 'bg-green-100 text-green-800',
                                    ][$status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $lap->judul ?? ($lap->judul_laporan ?? '—') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Illuminate\Support\Carbon::parse($lap->created_at ?? ($lap->tanggal_laporan ?? now()))->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $badge }}">{{ $status }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.laporan.show', $lap->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500">Belum ada laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
