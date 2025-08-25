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
                <button id="btnTambahTimNonRutin"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 transform hover:scale-105">
                    + Tim Non Rutin
                </button>
                <button id="btnTambahTimRutin"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 transform hover:scale-105">
                    + Tim Rutin
                </button>
            </div>
            <div class="flex space-x-2">
                <button id="filterSemua"
                    class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-sm font-medium transition duration-200">
                    Semua
                </button>
                <button id="filterRutin"
                    class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-md text-sm transition duration-200">
                    Tim Rutin
                </button>
                <button id="filterNonRutin"
                    class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-md text-sm transition duration-200">
                    Tim Non-Rutin
                </button>
            </div>
        </div>

        <!-- Tabel Tim -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Tim
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipe
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Anggota
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jadwal/Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Tim Rutin Rows -->
                        @foreach ($timRutin ?? [] as $tim)
                            <tr class="hover:bg-gray-50 transition-all duration-200 tim-row" data-type="rutin">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $tim->nama_tim }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                                        Tim Rutin
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs">
                                        {{ \Illuminate\Support\Str::words($tim->deskripsi, 8, '...') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $tim->anggota->count() ?? 0 }} orang
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $tim->jadwal_pelaksanaan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('ketua.rutin.show', $tim->id) }}"
                                            class="text-blue-600 hover:text-blue-800 transition duration-200">
                                            Detail
                                        </a>
                                        <form action="{{ route('ketua.rutin.destroy', $tim->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus tim {{ $tim->nama_tim }}?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 transition duration-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        <!-- Tim Non-Rutin Rows -->
                        @foreach ($timNonRutin ?? [] as $tim)
                            <tr class="hover:bg-gray-50 transition-all duration-200 tim-row" data-type="non-rutin">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $tim->nama_tim }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-1"></div>
                                        Tim Non-Rutin
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs">
                                        {{ \Illuminate\Support\Str::words($tim->deskripsi, 8, '...') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $tim->anggota->count() ?? 0 }} orang
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $tim->status ?? 'Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('ketua.nonrutin.show', $tim->id) }}"
                                            class="text-blue-600 hover:text-blue-800 transition duration-200">
                                            Detail
                                        </a>
                                        <form action="{{ route('ketua.nonrutin.destroy', $tim->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus tim {{ $tim->nama_tim }}?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 transition duration-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        <!-- Empty State -->
                        @if ((!isset($timRutin) || count($timRutin) === 0) && (!isset($timNonRutin) || count($timNonRutin) === 0))
                            <tr id="emptyState">
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        <h3 class="text-sm font-medium text-gray-900 mb-1">Belum ada tim</h3>
                                        <p class="text-sm text-gray-500">Mulai dengan menambahkan tim rutin atau non-rutin
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tim Non Rutin -->
    <div id="modalTimNonRutin" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Animated Backdrop -->
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0, 0, 0, 0.1);"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Tim Non Rutin</h3>
                        <button id="btnCloseModalNonRutin"
                            class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('ketua.nonrutin.store') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tim</label>
                                <input type="text" name="nama_tim" value="{{ old('nama_tim') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 @error('nama_tim') border-red-300 @enderror"
                                    placeholder="Contoh: Tim Pemeliharaan Jalan">
                                @error('nama_tim')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea rows="3" name="deskripsi"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 @error('deskripsi') border-red-300 @enderror"
                                    placeholder="Deskripsi tugas tim">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Penanggung Jawab</label>
                                <select name="penanggung_jawab_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 @error('penanggung_jawab_id') border-red-300 @enderror">
                                    <option value="">Pilih Penanggung Jawab</option>
                                    @foreach ($users ?? [] as $pegawai)
                                        <option value="{{ $pegawai->id }}"
                                            {{ old('penanggung_jawab_id') == $pegawai->id ? 'selected' : '' }}>
                                            {{ $pegawai->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penanggung_jawab_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Laporan</label>
                                <select name="laporan_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 @error('laporan_id') border-red-300 @enderror">
                                    <option value="">Pilih Laporan yang ingin dieksekusi</option>
                                    @foreach ($laporans ?? [] as $laporan)
                                        <option value="{{ $laporan->id }}"
                                            {{ old('laporan_id') == $laporan->id ? 'selected' : '' }}>
                                            {{ $laporan->judul }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('laporan_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <input type="hidden" name="form_type" value="nonrutin">
                            <button type="button" id="btnBatalNonRutin"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200 transform hover:scale-105">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Tim Rutin -->
    <div id="modalTimRutin" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Animated Backdrop -->
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0, 0, 0, 0.1);"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Tim Rutin</h3>
                        <button id="btnCloseModalRutin" class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('ketua.rutin.store') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tim</label>
                                <input type="text" name="nama_tim" value="{{ old('nama_tim') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 @error('nama_tim') border-red-300 @enderror"
                                    placeholder="Contoh: Tim Proyek Jembatan">
                                @error('nama_tim')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Proyek</label>
                                <textarea rows="3" name="deskripsi"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 @error('deskripsi') border-red-300 @enderror"
                                    placeholder="Deskripsi proyek khusus">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Penanggung Jawab</label>
                                <select name="penanggung_jawab_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 @error('penanggung_jawab_id') border-red-300 @enderror">
                                    <option value="">Pilih Penanggung Jawab</option>
                                    @foreach ($users ?? [] as $pegawai)
                                        <option value="{{ $pegawai->id }}"
                                            {{ old('penanggung_jawab_id') == $pegawai->id ? 'selected' : '' }}>
                                            {{ $pegawai->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penanggung_jawab_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Kerja</label>
                                <select name="jadwal_pelaksanaan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 @error('jadwal_pelaksanaan') border-red-300 @enderror">
                                    <option value="">Pilih Jadwal</option>
                                    <option value="Senin - Jumat"
                                        {{ old('jadwal_pelaksanaan') == 'Senin - Jumat' ? 'selected' : '' }}>Senin - Jumat
                                    </option>
                                    <option value="Senin - Sabtu"
                                        {{ old('jadwal_pelaksanaan') == 'Senin - Sabtu' ? 'selected' : '' }}>Senin - Sabtu
                                    </option>
                                    <option value="Setiap Hari"
                                        {{ old('jadwal_pelaksanaan') == 'Setiap Hari' ? 'selected' : '' }}>Setiap Hari
                                    </option>
                                </select>
                                @error('jadwal_pelaksanaan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <input type="hidden" name="form_type" value="rutin">
                            <button type="button" id="btnBatalRutin"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition duration-200 transform hover:scale-105">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Animation Functions
            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                const backdrop = modal.querySelector('.modal-backdrop');
                const content = modal.querySelector('.modal-content');

                modal.classList.remove('hidden');

                // Force reflow
                modal.offsetHeight;

                // Animate in
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');

                content.classList.remove('opacity-0', 'scale-95');
                content.classList.add('opacity-100', 'scale-100');
            }

            function hideModal(modalId) {
                const modal = document.getElementById(modalId);
                const backdrop = modal.querySelector('.modal-backdrop');
                const content = modal.querySelector('.modal-content');

                // Animate out
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');

                content.classList.remove('opacity-100', 'scale-100');
                content.classList.add('opacity-0', 'scale-95');

                // Hide after animation
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }

            // Auto-open modal if there are validation errors
            @if ($errors->any() && old('_token'))
                @if (old('form_type') === 'rutin')
                    showModal('modalTimRutin');
                @elseif (old('form_type') === 'nonrutin')
                    showModal('modalTimNonRutin');
                @endif
            @endif

            // Modal open handlers
            document.getElementById('btnTambahTimNonRutin').addEventListener('click', function() {
                showModal('modalTimNonRutin');
            });

            document.getElementById('btnTambahTimRutin').addEventListener('click', function() {
                showModal('modalTimRutin');
            });

            // Modal close handlers
            document.getElementById('btnBatalNonRutin').addEventListener('click', function() {
                hideModal('modalTimNonRutin');
            });

            document.getElementById('btnBatalRutin').addEventListener('click', function() {
                hideModal('modalTimRutin');
            });

            document.getElementById('btnCloseModalNonRutin').addEventListener('click', function() {
                hideModal('modalTimNonRutin');
            });

            document.getElementById('btnCloseModalRutin').addEventListener('click', function() {
                hideModal('modalTimRutin');
            });

            // Filter handlers with smooth transitions
            const filterButtons = ['filterSemua', 'filterRutin', 'filterNonRutin'];
            const timRows = document.querySelectorAll('.tim-row');

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

                    // Filter table rows with smooth animation
                    const filterType = buttonId.replace('filter', '').toLowerCase();

                    timRows.forEach((row, index) => {
                        setTimeout(() => {
                            if (filterType === 'semua') {
                                row.style.display = 'table-row';
                                row.style.opacity = '0';

                                setTimeout(() => {
                                    row.style.opacity = '1';
                                }, 50);
                            } else if (filterType === 'rutin' && row.dataset
                                .type === 'rutin') {
                                row.style.display = 'table-row';
                                row.style.opacity = '0';

                                setTimeout(() => {
                                    row.style.opacity = '1';
                                }, 50);
                            } else if (filterType === 'nonrutin' && row.dataset
                                .type === 'non-rutin') {
                                row.style.display = 'table-row';
                                row.style.opacity = '0';

                                setTimeout(() => {
                                    row.style.opacity = '1';
                                }, 50);
                            } else {
                                row.style.opacity = '0';

                                setTimeout(() => {
                                    row.style.display = 'none';
                                }, 200);
                            }
                        }, index * 30); // Faster stagger for table rows
                    });
                });
            });

            // Close modal when clicking on backdrop
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal-backdrop')) {
                    if (e.target.closest('#modalTimRutin')) {
                        hideModal('modalTimRutin');
                    }
                    if (e.target.closest('#modalTimNonRutin')) {
                        hideModal('modalTimNonRutin');
                    }
                }
            });

            // ESC key to close modals
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideModal('modalTimRutin');
                    hideModal('modalTimNonRutin');
                }
            });

            // Add smooth transitions to table rows on load
            timRows.forEach((row, index) => {
                row.style.opacity = '0';

                setTimeout(() => {
                    row.style.transition = 'opacity 0.5s ease, background-color 0.2s ease';
                    row.style.opacity = '1';
                }, index * 50);
            });s
        });
    </script>
@endpush
