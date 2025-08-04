@extends('layouts.app')

@section('title', 'Daftar Laporan Warga')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Daftar Laporan Warga</h1>
                    <p class="mt-1 text-blue-100">Kelola dan assign laporan dari warga ke tim yang sesuai</p>
                </div>
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Filter & Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Pending</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] ?? '23' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Ditugaskan</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['assigned'] ?? '15' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Dalam Proses</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['in_progress'] ?? '42' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Selesai</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed'] ?? '128' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-4 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div class="flex flex-wrap gap-3">
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="assigned">Ditugaskan</option>
                        <option value="in_progress">Dalam Proses</option>
                        <option value="completed">Selesai</option>
                    </select>
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Kategori</option>
                        <option value="jalan">Jalan</option>
                        <option value="drainase">Drainase</option>
                        <option value="jembatan">Jembatan</option>
                        <option value="lampu_jalan">Lampu Jalan</option>
                        <option value="fasilitas_umum">Fasilitas Umum</option>
                    </select>
                    <select
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Prioritas</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="sedang">Sedang</option>
                        <option value="rendah">Rendah</option>
                    </select>
                </div>
                <div class="flex items-center space-x-3">
                    <input type="text" placeholder="Cari laporan..."
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <button
                        class="bg-blue-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                        Cari
                    </button>
                </div>
            </div>
        </div>

        <!-- Laporan Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Laporan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelapor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Prioritas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($laporan ?? [] as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item['judul'] ?? 'Jalan berlubang parah' }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit($item['lokasi'] ?? 'Jl. Merdeka No. 123', 40) }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $item['pelapor'] ?? 'Ahmad Susanto' }}</div>
                                    <div class="text-sm text-gray-500">{{ $item['kontak'] ?? '081234567890' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                        {{ ucfirst($item['kategori'] ?? 'jalan') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $prioritas = $item['prioritas'] ?? 'sedang';
                                        $prioritasColors = [
                                            'tinggi' => 'bg-red-100 text-red-800',
                                            'sedang' => 'bg-yellow-100 text-yellow-800',
                                            'rendah' => 'bg-green-100 text-green-800',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $prioritasColors[$prioritas] }}">
                                        {{ ucfirst($prioritas) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $status = $item['status'] ?? 'pending';
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'assigned' => 'bg-blue-100 text-blue-800',
                                            'in_progress' => 'bg-purple-100 text-purple-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$status] }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $item['created_at'] ?? '2 Jan 2024' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            Detail
                                        </button>
                                        @if ($status === 'pending')
                                            <button
                                                class="text-green-600 hover:text-green-800 text-sm font-medium assign-btn"
                                                data-laporan-id="{{ $item['id'] ?? $loop->index }}">
                                                Assign
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Data dummy untuk contoh -->
                            @for ($i = 1; $i <= 15; $i++)
                                @php
                                    $statuses = ['pending', 'assigned', 'in_progress', 'completed'];
                                    $categories = ['jalan', 'drainase', 'jembatan', 'lampu_jalan', 'fasilitas_umum'];
                                    $priorities = ['tinggi', 'sedang', 'rendah'];

                                    $randomStatus = $statuses[array_rand($statuses)];
                                    $randomCategory = $categories[array_rand($categories)];
                                    $randomPriority = $priorities[array_rand($priorities)];

                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'assigned' => 'bg-blue-100 text-blue-800',
                                        'in_progress' => 'bg-purple-100 text-purple-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                    ];

                                    $prioritasColors = [
                                        'tinggi' => 'bg-red-100 text-red-800',
                                        'sedang' => 'bg-yellow-100 text-yellow-800',
                                        'rendah' => 'bg-green-100 text-green-800',
                                    ];

                                    $titles = [
                                        'Jalan berlubang parah',
                                        'Drainase tersumbat',
                                        'Lampu jalan mati',
                                        'Jembatan retak',
                                        'Fasilitas rusak',
                                        'Trotoar rusak',
                                        'Gorong-gorong bocor',
                                    ];

                                    $locations = [
                                        'Jl. Merdeka No. 123',
                                        'Jl. Sudirman Km. 5',
                                        'Jl. Diponegoro 45',
                                        'Jl. Ahmad Yani 78',
                                        'Jl. Gatot Subroto 90',
                                        'Jl. Veteran 12',
                                    ];

                                    $names = [
                                        'Ahmad Susanto',
                                        'Budi Prasetyo',
                                        'Siti Nurhaliza',
                                        'Eko Wijaya',
                                        'Maya Sari',
                                    ];
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $titles[array_rand($titles)] }}</div>
                                            <div class="text-sm text-gray-500">{{ $locations[array_rand($locations)] }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $names[array_rand($names)] }}</div>
                                        <div class="text-sm text-gray-500">081234567{{ sprintf('%03d', $i) }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                            {{ ucfirst($randomCategory) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full {{ $prioritasColors[$randomPriority] }}">
                                            {{ ucfirst($randomPriority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$randomStatus] }}">
                                            {{ ucfirst($randomStatus) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ date('d M Y', strtotime("-{$i} days")) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Detail
                                            </button>
                                            @if ($randomStatus === 'pending')
                                                <button
                                                    class="text-green-600 hover:text-green-800 text-sm font-medium assign-btn"
                                                    data-laporan-id="{{ $i }}">
                                                    Assign
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Menampilkan 1-15 dari {{ $total_laporan ?? '208' }} laporan
            </div>
            <nav class="flex items-center space-x-2">
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                    ← Sebelumnya
                </button>
                <button class="px-3 py-2 text-sm bg-blue-600 text-white rounded">1</button>
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700">2</button>
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700">3</button>
                <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700">
                    Selanjutnya →
                </button>
            </nav>
        </div>
    </div>

    <!-- Modal Assign Tim -->
    <div id="modalAssignTim" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Assign Laporan ke Tim</h3>
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Tim</label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">Pilih Tim</option>
                                    <option value="tim_rutin_1">Tim Pemeliharaan 1</option>
                                    <option value="tim_rutin_2">Tim Pemeliharaan 2</option>
                                    <option value="tim_non_rutin_1">Tim Proyek Jembatan</option>
                                    <option value="tim_non_rutin_2">Tim Emergency Response</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prioritas</label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="tinggi">Tinggi</option>
                                    <option value="sedang" selected>Sedang</option>
                                    <option value="rendah">Rendah</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Target Selesai</label>
                                <input type="date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                                <textarea rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="Catatan khusus untuk tim"></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalAssign"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Assign Tim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Assign modal handlers
        document.querySelectorAll('.assign-btn').forEach(button => {
            button.addEventListener('click', function() {
                const laporanId = this.dataset.laporanId;
                document.getElementById('modalAssignTim').classList.remove('hidden');
            });
        });

        document.getElementById('btnBatalAssign').addEventListener('click', function() {
            document.getElementById('modalAssignTim').classList.add('hidden');
        });

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'modalAssignTim') {
                document.getElementById('modalAssignTim').classList.add('hidden');
            }
        });
    </script>
@endpush
