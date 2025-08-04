@extends('layouts.app')

@section('title', 'Kelola Tim')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Kelola Tim</h1>
                    <p class="mt-1 text-blue-100">Atur tim rutin dan non-rutin untuk bidang Anda</p>
                </div>
                <a href="{{ route('ketua.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
            <div class="flex space-x-3 mb-4 sm:mb-0">
                <button id="btnTambahTimRutin"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    + Tim Rutin
                </button>
                <button id="btnTambahTimNonRutin"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    + Tim Non-Rutin
                </button>
            </div>
            <div class="flex space-x-2">
                <button id="filterSemua" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-sm font-medium">
                    Semua
                </button>
                <button id="filterRutin" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-md text-sm">
                    Tim Rutin
                </button>
                <button id="filterNonRutin" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-md text-sm">
                    Tim Non-Rutin
                </button>
            </div>
        </div>

        <!-- Tim Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Tim Rutin Cards -->
            @forelse ($tim_rutin ?? [] as $tim)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 tim-card" data-type="rutin">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Tim
                                Rutin</span>
                        </div>
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-blue-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>
                            <button class="text-gray-400 hover:text-red-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $tim['nama'] ?? 'Tim Pemeliharaan Rutin' }}</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ $tim['deskripsi'] ?? 'Tim untuk pemeliharaan infrastruktur rutin harian' }}</p>

                    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-500">Anggota:</span>
                            <span class="font-medium">{{ $tim['jumlah_anggota'] ?? '5' }} orang</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Status:</span>
                            <span class="font-medium text-green-600">Aktif</span>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Jadwal:</span>
                            <span class="font-medium">{{ $tim['jadwal'] ?? 'Senin - Jumat' }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Data dummy Tim Rutin -->
                @for ($i = 1; $i <= 3; $i++)
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6 tim-card" data-type="rutin">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Tim
                                    Rutin</span>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-gray-400 hover:text-blue-600 p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-gray-400 hover:text-red-600 p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tim Pemeliharaan {{ $i }}</h3>
                        <p class="text-sm text-gray-600 mb-4">Tim untuk pemeliharaan infrastruktur rutin area
                            {{ $i }}</p>

                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <span class="text-gray-500">Anggota:</span>
                                <span class="font-medium">{{ 4 + $i }} orang</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span class="font-medium text-green-600">Aktif</span>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Jadwal:</span>
                                <span class="font-medium">Senin - Jumat</span>
                            </div>
                            <div class="mt-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse

            <!-- Tim Non-Rutin Cards -->
            @forelse ($tim_non_rutin ?? [] as $tim)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 tim-card" data-type="non-rutin">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">Tim
                                Non-Rutin</span>
                        </div>
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-blue-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>
                            <button class="text-gray-400 hover:text-red-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $tim['nama'] ?? 'Tim Proyek Khusus' }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $tim['deskripsi'] ?? 'Tim untuk penanganan proyek khusus' }}
                    </p>

                    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-500">Anggota:</span>
                            <span class="font-medium">{{ $tim['jumlah_anggota'] ?? '8' }} orang</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Status:</span>
                            <span class="font-medium text-blue-600">{{ $tim['status'] ?? 'Dalam Tugas' }}</span>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Deadline:</span>
                            <span class="font-medium">{{ $tim['deadline'] ?? '30 Des 2024' }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Data dummy Tim Non-Rutin -->
                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6 tim-card" data-type="non-rutin">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">Tim
                                    Non-Rutin</span>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-gray-400 hover:text-blue-600 p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-gray-400 hover:text-red-600 p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        @php
                            $teamNames = ['Proyek Jembatan', 'Emergency Response', 'Renovasi Fasum', 'Tim Darurat'];
                            $statuses = ['Dalam Tugas', 'Standby', 'Selesai'];
                            $randomStatus = $statuses[array_rand($statuses)];
                            $statusColors = [
                                'Dalam Tugas' => 'text-blue-600',
                                'Standby' => 'text-yellow-600',
                                'Selesai' => 'text-green-600',
                            ];
                        @endphp

                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $teamNames[$i - 1] }}</h3>
                        <p class="text-sm text-gray-600 mb-4">Tim khusus untuk menangani
                            {{ strtolower($teamNames[$i - 1]) }}</p>

                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <span class="text-gray-500">Anggota:</span>
                                <span class="font-medium">{{ 6 + $i }} orang</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span class="font-medium {{ $statusColors[$randomStatus] }}">{{ $randomStatus }}</span>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Deadline:</span>
                                <span class="font-medium">{{ date('d M Y', strtotime("+{$i} weeks")) }}</span>
                            </div>
                            <div class="mt-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>

    <!-- Modal Form Tim Rutin -->
    <div id="modalTimRutin" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Tim Rutin</h3>
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tim</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="Contoh: Tim Pemeliharaan Jalan">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="Deskripsi tugas tim"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Kerja</label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option>Senin - Jumat</option>
                                    <option>Senin - Sabtu</option>
                                    <option>Setiap Hari</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalRutin"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Tim Non-Rutin -->
    <div id="modalTimNonRutin" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Tim Non-Rutin</h3>
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tim</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    placeholder="Contoh: Tim Proyek Jembatan">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Proyek</label>
                                <textarea rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    placeholder="Deskripsi proyek khusus"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                                    <input type="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                                    <input type="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalNonRutin"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                Simpan
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
        // Modal handlers
        document.getElementById('btnTambahTimRutin').addEventListener('click', function() {
            document.getElementById('modalTimRutin').classList.remove('hidden');
        });

        document.getElementById('btnTambahTimNonRutin').addEventListener('click', function() {
            document.getElementById('modalTimNonRutin').classList.remove('hidden');
        });

        document.getElementById('btnBatalRutin').addEventListener('click', function() {
            document.getElementById('modalTimRutin').classList.add('hidden');
        });

        document.getElementById('btnBatalNonRutin').addEventListener('click', function() {
            document.getElementById('modalTimNonRutin').classList.add('hidden');
        });

        // Filter handlers
        const filterButtons = ['filterSemua', 'filterRutin', 'filterNonRutin'];
        const timCards = document.querySelectorAll('.tim-card');

        filterButtons.forEach(buttonId => {
            document.getElementById(buttonId).addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(id => {
                    const btn = document.getElementById(id);
                    btn.classList.remove('bg-blue-100', 'text-blue-800');
                    btn.classList.add('text-gray-600', 'hover:bg-gray-100');
                });

                this.classList.remove('text-gray-600', 'hover:bg-gray-100');
                this.classList.add('bg-blue-100', 'text-blue-800');

                // Filter cards
                const filterType = buttonId.replace('filter', '').toLowerCase();

                timCards.forEach(card => {
                    if (filterType === 'semua') {
                        card.style.display = 'block';
                    } else if (filterType === 'rutin' && card.dataset.type === 'rutin') {
                        card.style.display = 'block';
                    } else if (filterType === 'nonrutin' && card.dataset.type === 'non-rutin') {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'modalTimRutin') {
                document.getElementById('modalTimRutin').classList.add('hidden');
            }
            if (e.target.id === 'modalTimNonRutin') {
                document.getElementById('modalTimNonRutin').classList.add('hidden');
            }
        });
    </script>
@endpush
