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
                <a href="{{ route('ketua.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

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
                        <p class="text-sm text-gray-600">Menunggu Verifikasi</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Diterima</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['diterima'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Selesai</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['selesai'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Ditolak</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['ditolak'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-4 mb-6">
            <form method="GET" action="">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <div class="flex flex-wrap gap-3">
                        <select name="status_verifikasi"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status_verifikasi') == 'pending' ? 'selected' : '' }}>
                                Menunggu Verifikasi</option>
                            <option value="diterima" {{ request('status_verifikasi') == 'diterima' ? 'selected' : '' }}>
                                Diterima</option>
                            <option value="ditolak" {{ request('status_verifikasi') == 'ditolak' ? 'selected' : '' }}>
                                Ditolak</option>
                            <option value="selesai" {{ request('status_verifikasi') == 'selesai' ? 'selected' : '' }}>
                                Selesai</option>
                        </select>
                        <select name="bidang_id"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Semua Bidang</option>
                            @foreach ($bidangs ?? [] as $bidang)
                                <option value="{{ $bidang->id }}"
                                    {{ request('bidang_id') == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama }}
                                </option>
                            @endforeach
                        </select>
                        <select name="sort_by"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Urutkan</option>
                            <option value="tanggal_terbaru"
                                {{ request('sort_by') == 'tanggal_terbaru' ? 'selected' : '' }}>Tanggal Terbaru</option>
                            <option value="tanggal_terlama"
                                {{ request('sort_by') == 'tanggal_terlama' ? 'selected' : '' }}>Tanggal Terlama</option>
                            <option value="nama_az" {{ request('sort_by') == 'nama_az' ? 'selected' : '' }}>Nama A-Z
                            </option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-3">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul laporan..."
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                            Cari
                        </button>
                        <a href=""
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
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
                                Bidang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($laporans ?? [] as $laporan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $laporan->judul }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit($laporan->alamat, 40) }}</div>
                                        @if ($laporan->foto)
                                            <div class="mt-1">
                                                <span class="text-xs text-blue-600">📷 Ada foto</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $laporan->nama_pelapor }}</div>
                                    <div class="text-sm text-gray-500">{{ $laporan->kontak_pelapor }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        {{ $laporan->bidang->nama ?? 'Tidak ada bidang' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'diterima' => 'bg-blue-100 text-blue-800',
                                            'ditolak' => 'bg-red-100 text-red-800',
                                            'selesai' => 'bg-green-100 text-green-800',
                                        ];
                                        $statusText = [
                                            'pending' => 'Menunggu Verifikasi',
                                            'diterima' => 'Diterima',
                                            'ditolak' => 'Ditolak',
                                            'selesai' => 'Selesai',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$laporan->status_verifikasi] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $statusText[$laporan->status_verifikasi] ?? ucfirst($laporan->status_verifikasi) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $laporan->tanggal_laporan ? $laporan->tanggal_laporan->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('ketua.detail-laporan.single.show', ['id' => $laporan->id ?? $laporan['id']]) }}"
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 hover:bg-blue-200">
                                            Detail
                                        </a>

                                        @if ($laporan->status_verifikasi === 'diterima' && !$laporan->timNonRutin)
                                            <button
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 hover:bg-green-200 assign-btn" ">
                                                    Assign
                                                </button>
     @endif

                                                @if ($laporan->status_verifikasi === 'pending')
                                                    <button
                                                        class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800 hover:bg-purple-200 verify-btn"
                                                        onclick="showVerifyModal({{ $laporan->id }}, '{{ $laporan->judul }}')">
                                                        Verifikasi
                                                    </button>
                                                @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if (method_exists($laporans, 'links'))
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $laporans->firstItem() ?? 0 }}-{{ $laporans->lastItem() ?? 0 }} dari
                    {{ $laporans->total() ?? 0 }} laporan
                </div>
                {{ $laporans->links() }}
            </div>
        @else
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $laporans->count() }} laporan
                </div>
                <nav class="flex items-center space-x-2">
                    <span class="px-3 py-2 text-sm bg-blue-600 text-white rounded">1</span>
                </nav>
            </div>
        @endif
    </div>

    <!-- Modal Assign Tim -->
    <div id="modalAssignTim" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0, 0, 0, 0.1);"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Assign Laporan ke Tim</h3>
                        <button onclick="closeModal('modalAssignTim')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Assign form content here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Verifikasi Laporan (Simplified) -->
    <div id="modalVerifikasi" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0, 0, 0, 0.3);"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Verifikasi Laporan</h3>
                        <button onclick="closeModal('modalVerifikasi')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div id="laporanInfo" class="mb-4 p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600">Laporan:</p>
                        <p id="judulLaporan" class="font-medium text-gray-900"></p>
                    </div>

                    <!-- Form Terima -->
                    <form method="POST" action="" id="formTerima" class="mb-3">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status_verifikasi" value="diterima">
                        <input type="hidden" name="catatan_verifikasi" value="Laporan telah diverifikasi dan diterima">
                        <button type="submit"
                            class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 font-medium flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Terima Laporan
                        </button>
                    </form>

                    <!-- Form Tolak -->
                    <form method="POST" action="" id="formTolak">
                        @csrf
                        <input type="hidden" name="status_verifikasi" value="ditolak">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alasan penolakan:</label>
                            <textarea name="catatan_verifikasi" rows="3" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none"
                                placeholder="Jelaskan alasan penolakan laporan ini..."></textarea>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 font-medium flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Tolak Laporan
                        </button>
                    </form>

                    <div class="mt-4 pt-4 border-t">
                        <button type="button" onclick="closeModal('modalVerifikasi')"
                            class="w-full px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Animation Functions
            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                const backdrop = modal.querySelector('.modal-backdrop');
                const content = modal.querySelector('.modal-content');

                modal.classList.remove('hidden');
                modal.offsetHeight; // Force reflow

                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                content.classList.remove('opacity-0', 'scale-95');
                content.classList.add('opacity-100', 'scale-100');
            }

            function hideModal(modalId) {
                const modal = document.getElementById(modalId);
                const backdrop = modal.querySelector('.modal-backdrop');
                const content = modal.querySelector('.modal-content');

                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                content.classList.remove('opacity-100', 'scale-100');
                content.classList.add('opacity-0', 'scale-95');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    // Reset forms
                    const forms = modal.querySelectorAll('form');
                    forms.forEach(form => form.reset());
                }, 300);
            }

            // Make functions globally available
            window.showModal = showModal;
            window.closeModal = hideModal;

            // Verify modal with simple forms
            window.showVerifyModal = function(laporanId, judulLaporan) {
                document.getElementById('judulLaporan').textContent = judulLaporan;
                document.getElementById('formTerima').action = `/ketua/laporan/${laporanId}/verify`;
                document.getElementById('formTolak').action = `/ketua/laporan/${laporanId}/verify`;

                showModal('modalVerifikasi');
            }

            // Assign modal (keep existing functionality if needed)
            window.showAssignModal = function(laporanId) {
                showModal('modalAssignTim');
            }

            // Close modals when clicking backdrop
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal-backdrop')) {
                    const modal = e.target.closest('[id^="modal"]');
                    if (modal) {
                        hideModal(modal.id);
                    }
                }
            });

            // ESC key to close modals
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const openModal = document.querySelector('[id^="modal"]:not(.hidden)');
                    if (openModal) {
                        hideModal(openModal.id);
                    }
                }
            });
        });
    </script>
@endpush
