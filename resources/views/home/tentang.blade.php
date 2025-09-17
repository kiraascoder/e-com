@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
    <!-- Hero -->
    <section class="relative bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-3xl md:text-5xl font-bold">Tentang Dinas Pekerjaan Umum</h1>
            <p class="mt-4 text-blue-100 max-w-3xl">
                Kami berkomitmen menyediakan infrastruktur yang andal, aman, dan berkelanjutan
                melalui layanan yang efektif, transparan, dan kolaboratif.
            </p>
        </div>
    </section>

    <!-- Ringkas Profil -->
    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-gray-900">Profil Singkat</h2>
                <p class="mt-3 text-gray-600 leading-relaxed">
                    Dinas Pekerjaan Umum (PU) berperan dalam perencanaan, pembangunan, dan pemeliharaan
                    infrastruktur daerah: jalan dan jembatan, permukiman dan bangunan, penataan ruang,
                    serta pengelolaan sumber daya air. Sistem pelaporan berbasis web memudahkan masyarakat
                    menyampaikan keluhan fasilitas publik dan memantau tindak lanjutnya secara real-time.
                </p>
            </div>            
        </div>
    </section>

    <!-- Visi Misi Nilai -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-6 border">
                <h3 class="text-xl font-semibold text-gray-900">Visi</h3>
                <p class="mt-2 text-gray-600">
                    Terwujudnya infrastruktur publik yang berkualitas, inklusif, dan berkelanjutan
                    untuk mendorong pertumbuhan ekonomi dan kesejahteraan masyarakat.
                </p>
            </div>
            <div class="bg-white rounded-2xl p-6 border">
                <h3 class="text-xl font-semibold text-gray-900">Misi</h3>
                <ul class="mt-2 text-gray-600 list-disc list-inside space-y-1">
                    <li>Mempercepat penyediaan dan pemeliharaan infrastruktur prioritas.</li>
                    <li>Menerapkan tata kelola yang transparan berbasis data.</li>
                    <li>Memperkuat kolaborasi dengan masyarakat dan pemangku kepentingan.</li>
                </ul>
            </div>
            <div class="bg-white rounded-2xl p-6 border">
                <h3 class="text-xl font-semibold text-gray-900">Nilai</h3>
                <ul class="mt-2 text-gray-600 list-disc list-inside space-y-1">
                    <li>Integritas & Akuntabilitas</li>
                    <li>Pelayanan Publik Responsif</li>
                    <li>Keselamatan & Keberlanjutan</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Tugas & Fungsi -->
    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900">Tugas & Fungsi</h2>
            <div class="mt-4 grid md:grid-cols-2 gap-6">
                <div class="rounded-2xl border p-6">
                    <h4 class="font-semibold text-gray-900">Tugas</h4>
                    <p class="mt-2 text-gray-600">Merumuskan kebijakan, melaksanakan pembangunan, serta
                        mengendalikan dan mengevaluasi penyelenggaraan infrastruktur wilayah.</p>
                </div>
                <div class="rounded-2xl border p-6">
                    <h4 class="font-semibold text-gray-900">Fungsi</h4>
                    <ul class="mt-2 text-gray-600 list-disc list-inside space-y-1">
                        <li>Perencanaan & penganggaran program infrastruktur.</li>
                        <li>Pelaksanaan konstruksi dan pemeliharaan.</li>
                        <li>Pengawasan mutu, keselamatan, dan keberlanjutan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Bidang (tautan ke halaman Bidang) -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900">Struktur Bidang</h2>
            <p class="mt-2 text-gray-600">Empat bidang utama yang menangani layanan inti Dinas PU.</p>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('bidang.index') }}#tataruang" class="rounded-2xl border p-5 hover:shadow-md transition">
                    🗺️ <span class="font-semibold">Tata Ruang</span>
                    <p class="text-sm text-gray-600 mt-1">Penataan & pengendalian pemanfaatan ruang.</p>
                </a>
                <a href="{{ route('bidang.index') }}#binamarga" class="rounded-2xl border p-5 hover:shadow-md transition">
                    🛣️ <span class="font-semibold">Bina Marga</span>
                    <p class="text-sm text-gray-600 mt-1">Jalan, jembatan, keselamatan lalu lintas.</p>
                </a>
                <a href="{{ route('bidang.index') }}#ciptakarya" class="rounded-2xl border p-5 hover:shadow-md transition">
                    🏛️ <span class="font-semibold">Cipta Karya</span>
                    <p class="text-sm text-gray-600 mt-1">Permukiman, bangunan, PJU, sanitasi.</p>
                </a>
                <a href="{{ route('bidang.index') }}#sda" class="rounded-2xl border p-5 hover:shadow-md transition">
                    💧 <span class="font-semibold">Sumber Daya Air</span>
                    <p class="text-sm text-gray-600 mt-1">Drainase, sungai/irigasi, pengendalian banjir.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Timeline singkat -->
    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900">Perjalanan Layanan</h2>
            <div class="mt-6 space-y-6">
                <div class="flex items-start gap-4">
                    <div class="h-6 w-6 rounded-full bg-blue-600"></div>
                    <div>
                        <p class="font-semibold">2023 — Implementasi Pelaporan Online</p>
                        <p class="text-gray-600 text-sm">Masyarakat dapat mengirim laporan dan memantau statusnya.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="h-6 w-6 rounded-full bg-green-600"></div>
                    <div>
                        <p class="font-semibold">2024 — Integrasi Manajemen Tim</p>
                        <p class="text-gray-600 text-sm">Penugasan tim rutin/non-rutin dan monitoring pengerjaan.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="h-6 w-6 rounded-full bg-purple-600"></div>
                    <div>
                        <p class="font-semibold">2025 — Dashboard Analitik</p>
                        <p class="text-gray-600 text-sm">Analisis tren laporan, SLA, dan sebaran lokasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>        
@endsection
