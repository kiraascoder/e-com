@extends('layouts.app')

@section('title', 'Kelola Bidang')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Kelola Bidang</h1>
                    <p class="mt-1 text-blue-100">Atur Bidang Dinas Pekerjaan Umum</p>
                </div>
                <a href="{{ route('admin.dashboard') }}"
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
                <button id="btnTambahBidang"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    + Tambah Bidang
                </button>
            </div>
        </div>



        <!-- Tim Cards -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bidang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ketua</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($bidangs ?? [] as $bidang)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $bidang->nama }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $bidang->ketua->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.bidang.show', $bidang->id) }}">
                                            <p class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detail</p>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if (method_exists($bidangs, 'links'))
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $bidangs->firstItem() ?? 0 }}-{{ $bidangs->lastItem() ?? 0 }} dari
                    {{ $bidangs->total() ?? 0 }} bidang
                </div>
                {{ $bidangs->links() }}
            </div>
        @else
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $bidangs->count() }} bidang
                </div>
                <nav class="flex items-center space-x-2">
                    <span class="px-3 py-2 text-sm bg-blue-600 text-white rounded">1</span>
                </nav>
            </div>
        @endif
    </div>
    </div>

    <!-- Modal Form Tim Rutin -->
    <!-- Modal Form Bidang -->
    <div id="modalBidang" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Animated Backdrop -->
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0,0,0,0.1);"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Bidang</h3>
                        <button id="btnCloseModalBidang" class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('admin.bidang.store') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bidang</label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 @error('nama') border-red-300 @enderror"
                                    placeholder="Contoh: Bidang Bina Marga">
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ketua Bidang</label>
                                <select name="ketua_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 @error('ketua_id') border-red-300 @enderror">
                                    <option value="">Pilih Ketua</option>
                                    @foreach ($users ?? [] as $u)
                                        <option value="{{ $u->id }}"
                                            {{ old('ketua_id') == $u->id ? 'selected' : '' }}>
                                            {{ $u->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ketua_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <input type="hidden" name="form_type" value="bidang">
                            <button type="button" id="btnBatalBidang"
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
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reusable modal anim
            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                const backdrop = modal.querySelector('.modal-backdrop');
                const content = modal.querySelector('.modal-content');

                modal.classList.remove('hidden');
                modal.offsetHeight; // reflow
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
                setTimeout(() => modal.classList.add('hidden'), 300);
            }

            // Open
            document.getElementById('btnTambahBidang')?.addEventListener('click', () => showModal('modalBidang'));

            // Close buttons
            document.getElementById('btnBatalBidang')?.addEventListener('click', () => hideModal('modalBidang'));
            document.getElementById('btnCloseModalBidang')?.addEventListener('click', () => hideModal(
                'modalBidang'));

            // Auto-open if validation failed
            @if ($errors->any() && old('_token') && old('form_type') === 'bidang')
                showModal('modalBidang');
            @endif

            // Close on backdrop click
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal-backdrop')) {
                    if (e.target.closest('#modalBidang')) hideModal('modalBidang');
                }
            });

            // ESC to close
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') hideModal('modalBidang');
            });
        });
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
