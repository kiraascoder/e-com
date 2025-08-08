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
                    <h1 class="text-2xl font-bold">Tim Pemeliharaan Infrastruktur</h1>
                    <p class="mt-1 text-blue-100">Tim untuk pemeliharaan infrastruktur rutin harian meliputi jalan, saluran
                        air, dan fasilitas umum</p>
                </div>
                <div class="flex space-x-3">
                    <button
                        class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        Edit Tim
                    </button>
                    <a href="{{ route('ketua.tim') }}"
                        class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Statistik Tim -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Anggota</p>
                        <p class="text-2xl font-semibold text-gray-900">7</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Tugas Selesai</p>
                        <p class="text-2xl font-semibold text-gray-900">34</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Sedang Berjalan</p>
                        <p class="text-2xl font-semibold text-gray-900">5</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Efektivitas</p>
                        <p class="text-2xl font-semibold text-gray-900">87%</p>
                    </div>
                </div>
            </div>
        </div>

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
                            <p class="text-sm text-gray-900">Senin - Jumat</p>
                            <p class="text-xs text-gray-500">08:00 - 17:00 WIB</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Dibentuk</label>
                            <p class="text-sm text-gray-900">15 Januari 2024</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Area Tanggung Jawab</label>
                            <p class="text-sm text-gray-900">Kecamatan Biringkanaya</p>
                            <p class="text-xs text-gray-500">Meliputi 12 kelurahan</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Ketua Tim</label>
                            <p class="text-sm text-gray-900">Ahmad Wijaya</p>
                            <p class="text-xs text-gray-500">NIP: 196805121990031002</p>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Kerja Mingguan -->
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Jadwal Mingguan</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Senin</span>
                            <span class="text-sm font-medium text-green-600">Patroli Rutin</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Selasa</span>
                            <span class="text-sm font-medium text-green-600">Pemeliharaan Jalan</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Rabu</span>
                            <span class="text-sm font-medium text-green-600">Pembersihan Saluran</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Kamis</span>
                            <span class="text-sm font-medium text-green-600">Pemeliharaan Fasum</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-gray-600">Jumat</span>
                            <span class="text-sm font-medium text-green-600">Evaluasi & Laporan</span>
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
                            <button id="tabAktivitas"
                                class="tab-btn py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                                Aktivitas Terbaru
                            </button>
                            <button id="tabTugas"
                                class="tab-btn py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                                Tugas Berjalan
                            </button>
                        </nav>
                    </div>

                    <!-- Content Anggota Tim -->
                    <div id="contentAnggota" class="tab-content p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Anggota</h3>
                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                                + Tambah Anggota
                            </button>
                        </div>
                        <div class="space-y-4">
                            <!-- Anggota 1 -->
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-medium">
                                        AW
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Ahmad Wijaya</p>
                                        <p class="text-xs text-gray-500">NIP: 196805121990031002</p>
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full mt-1">
                                            Ketua Tim
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-900">Teknisi Senior</p>
                                    <p class="text-xs text-gray-500">Bergabung: Jan 2024</p>
                                </div>
                            </div>

                            <!-- Anggota 2 -->
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-medium">
                                        BS
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                                        <p class="text-xs text-gray-500">NIP: 197203151992031003</p>
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full mt-1">
                                            Anggota
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-900">Teknisi</p>
                                    <p class="text-xs text-gray-500">Bergabung: Jan 2024</p>
                                </div>
                            </div>

                            <!-- Anggota 3 -->
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-medium">
                                        CK
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Candra Kusuma</p>
                                        <p class="text-xs text-gray-500">NIP: 198506201995031004</p>
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full mt-1">
                                            Anggota
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-900">Operator</p>
                                    <p class="text-xs text-gray-500">Bergabung: Feb 2024</p>
                                </div>
                            </div>

                            <!-- Anggota 4-7 -->
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white font-medium">
                                        DL
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Dedi Lesmana</p>
                                        <p class="text-xs text-gray-500">NIP: 199108151998031005</p>
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full mt-1">
                                            Anggota
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-900">Teknisi</p>
                                    <p class="text-xs text-gray-500">Bergabung: Feb 2024</p>
                                </div>
                            </div>

                            <div class="text-center py-4">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Semua Anggota (7) →
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Content Aktivitas -->
                    <div id="contentAktivitas" class="tab-content p-6 hidden">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-4">
                            <div class="flex items-start p-4 border border-gray-200 rounded-lg">
                                <div class="p-2 bg-green-100 rounded-lg mr-4">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Perbaikan jalan Jl. Sunu selesai
                                        dikerjakan</p>
                                    <p class="text-xs text-gray-500 mt-1">Diselesaikan oleh Ahmad Wijaya • 2 jam yang lalu
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 border border-gray-200 rounded-lg">
                                <div class="p-2 bg-blue-100 rounded-lg mr-4">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Memulai pembersihan saluran air di
                                        Kelurahan Paccerakkang</p>
                                    <p class="text-xs text-gray-500 mt-1">Dikerjakan oleh Budi Santoso • 5 jam yang lalu
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 border border-gray-200 rounded-lg">
                                <div class="p-2 bg-yellow-100 rounded-lg mr-4">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Laporan baru: Lampu jalan mati di Jl.
                                        Perintis Kemerdekaan</p>
                                    <p class="text-xs text-gray-500 mt-1">Ditugaskan kepada Candra Kusuma • 1 hari yang
                                        lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Tugas -->
                    <div id="contentTugas" class="tab-content p-6 hidden">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tugas yang Sedang Berjalan</h3>
                        <div class="space-y-4">
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-sm font-medium text-gray-900">Perbaikan Lubang Jalan Jl. Antang Raya
                                    </h4>
                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                        Dalam Progress
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600 mb-3">Ditugaskan kepada: Ahmad Wijaya, Budi Santoso</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Progress: 75%</span>
                                    <span>Deadline: 10 Agu 2025</span>
                                </div>
                            </div>

                            <div class="p-4 border border-gray-200 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-sm font-medium text-gray-900">Pemeliharaan Taman Kota Biringkanaya</h4>
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        Baru Dimulai
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600 mb-3">Ditugaskan kepada: Candra Kusuma, Dedi Lesmana</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 25%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Progress: 25%</span>
                                    <span>Deadline: 15 Agu 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.id.replace('tab', 'content');

                    // Remove active classes from all tabs
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-blue-500', 'text-blue-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });

                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Activate clicked tab
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('border-blue-500', 'text-blue-600');

                    // Show corresponding content
                    document.getElementById(targetTab).classList.remove('hidden');
                });
            });
        });
    </script>
@endpush
