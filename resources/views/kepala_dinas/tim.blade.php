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
                <a href="{{ route('dinas.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
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
                                        <a href="{{ route('dinas.rutin.show', $tim->id) }}"
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
            });
            s
        });
    </script>
@endpush
