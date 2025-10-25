@extends('layouts.app')

@section('title', 'Detail Tim')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center mb-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Tim Rutin</span>
                    </div>
                    <h1 class="text-2xl font-bold">Tim {{ $timRutin->nama_tim }}</h1>
                    <p class="mt-1 text-blue-100">Tim untuk pemeliharaan infrastruktur rutin harian meliputi jalan, saluran
                        air, dan fasilitas umum</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('dinas.tim') }}"
                        class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informasi Tim -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tim</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <p class="text-sm text-green-600 font-medium">Aktif</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jadwal Kerja</label>
                            <p class="text-sm text-gray-900">{{ $timRutin->jadwal_pelaksanaan }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Dibentuk</label>
                            <p class="text-sm text-gray-900">{{ $timRutin->created_at }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Deskripsi Tim</label>
                            <p class="text-sm text-gray-900">{{ $timRutin->deskripsi }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Penanggung Jawab</label>
                            <p class="text-sm text-gray-900">{{ $timRutin->penanggungJawab->name }}</p>
                            {{-- <p class="text-xs text-gray-500">NIP: 196805121990031002</p> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anggota Tim & Aktivitas -->
            <div class="lg:col-span-2">
                <!-- Tab Navigation -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8 px-6">
                            <button id="tabAnggota"
                                class="tab-btn py-4 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm">
                                Anggota Tim
                            </button>
                        </nav>
                    </div>
                    <div id="contentAnggota" class="tab-content p-6">
                        <div class="space-y-4">
                            @if ($timRutinAnggota->penanggungJawab)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $timRutinAnggota->penanggungJawab->name }}</p>
                                            <p class="text-xs text-gray-500">Email :
                                                {{ $timRutinAnggota->penanggungJawab->email }}</p>
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full mt-1">
                                                Penanggung Jawab
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500">Bergabung:
                                            {{ $timRutinAnggota->penanggungJawab->created_at }}</p>
                                    </div>
                                </div>
                            @endif
                            @foreach ($timRutinAnggota->anggota ?? [] as $anggota)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">{{ $anggota->name }}</p>
                                            <p class="text-xs text-gray-500">Email : {{ $anggota->email }}</p>
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full mt-1">
                                                Anggota
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500">Bergabung: {{ $anggota->created_at }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('modalTambahAnggota');
            const openBtn = document.getElementById('btnTambahAnggota');
            const closeX = document.getElementById('btnCloseModalRutin');
            const closeBtn = document.getElementById('btnBatalRutin');
            const backdrop = modal?.querySelector('.modal-backdrop');
            const content = modal?.querySelector('.modal-content');

            function openModal() {
                if (!modal) return;
                modal.classList.remove('hidden');
                // biar CSS transition jalan, ubah setelah frame berikutnya
                requestAnimationFrame(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    content.classList.remove('opacity-0', 'scale-95');
                    content.classList.add('opacity-100', 'scale-100');
                    document.documentElement.classList.add('overflow-y-hidden');
                });
                trapFocus();
            }

            function closeModal() {
                if (!modal) return;
                backdrop.classList.add('opacity-0');
                backdrop.classList.remove('opacity-100');
                content.classList.add('opacity-0', 'scale-95');
                content.classList.remove('opacity-100', 'scale-100');
                // samakan dengan duration-300 di kelas Tailwind
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.documentElement.classList.remove('overflow-y-hidden');
                    openBtn?.focus();
                }, 300);
            }

            function trapFocus() {
                const focusables = modal.querySelectorAll(
                    'a[href],button,textarea,input,select,[tabindex]:not([tabindex="-1"])'
                );
                const first = focusables[0];
                const last = focusables[focusables.length - 1];
                first?.focus();

                function onKey(e) {
                    if (e.key === 'Escape') {
                        e.preventDefault();
                        closeModal();
                    }
                    if (e.key === 'Tab' && focusables.length) {
                        if (e.shiftKey && document.activeElement === first) {
                            e.preventDefault();
                            last.focus();
                        } else if (!e.shiftKey && document.activeElement === last) {
                            e.preventDefault();
                            first.focus();
                        }
                    }
                }
                modal.addEventListener('keydown', onKey, {
                    once: true
                });
            }

            // listeners
            openBtn?.addEventListener('click', openModal);
            closeX?.addEventListener('click', closeModal);
            closeBtn?.addEventListener('click', closeModal);
            backdrop?.addEventListener('click', (e) => {
                // tutup hanya bila klik area blur/gelapnya
                if (e.target === backdrop) closeModal();
            });
        });
    </script>
@endpush
