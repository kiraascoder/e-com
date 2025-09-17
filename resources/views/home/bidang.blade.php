@extends('layouts.app')

@section('title', 'Bidang Kerja')

@section('content')
    <!-- Hero -->
    <section class="relative bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-3xl md:text-5xl font-bold">Bidang Kerja Dinas Pekerjaan Umum</h1>
            <p class="mt-4 text-blue-100 max-w-3xl">
                Kenali peran dan layanan utama dari empat bidang: Tata Ruang, Bina Marga, Cipta Karya, dan Sumber Daya Air.
                Halaman ini membantu masyarakat memahami alur layanan dan jenis laporan yang relevan pada tiap bidang.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#tataruang" class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20">Tata Ruang</a>
                <a href="#binamarga" class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20">Bina Marga</a>
                <a href="#ciptakarya" class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20">Cipta Karya</a>
                <a href="#sda" class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20">Sumber Daya Air</a>
            </div>
        </div>
    </section>

    <!-- Ringkasan 4 Kartu -->
    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tata Ruang -->
                <a href="#tataruang" class="group rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition">
                    <div class="text-3xl">🗺️</div>
                    <h3 class="mt-3 font-semibold text-gray-900">Bidang Tata Ruang</h3>
                    <p class="mt-2 text-sm text-gray-600">Penataan ruang, kesesuaian rencana tata ruang (RTRW/RDTR), dan
                        perizinan terkait pemanfaatan ruang.</p>
                    <span class="mt-3 inline-block text-blue-600 text-sm group-hover:underline">Pelajari</span>
                </a>
                <!-- Bina Marga -->
                <a href="#binamarga" class="group rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition">
                    <div class="text-3xl">🛣️</div>
                    <h3 class="mt-3 font-semibold text-gray-900">Bidang Bina Marga</h3>
                    <p class="mt-2 text-sm text-gray-600">Pembangunan & pemeliharaan jalan-jembatan, marka & rambu, serta
                        keselamatan jalan.</p>
                    <span class="mt-3 inline-block text-blue-600 text-sm group-hover:underline">Pelajari</span>
                </a>
                <!-- Cipta Karya -->
                <a href="#ciptakarya" class="group rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition">
                    <div class="text-3xl">🏛️</div>
                    <h3 class="mt-3 font-semibold text-gray-900">Bidang Cipta Karya</h3>
                    <p class="mt-2 text-sm text-gray-600">Bangunan gedung, permukiman, sanitasi, persampahan, ruang terbuka
                        hijau & lampu PJU.</p>
                    <span class="mt-3 inline-block text-blue-600 text-sm group-hover:underline">Pelajari</span>
                </a>
                <!-- SDA -->
                <a href="#sda" class="group rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition">
                    <div class="text-3xl">💧</div>
                    <h3 class="mt-3 font-semibold text-gray-900">Bidang Sumber Daya Air</h3>
                    <p class="mt-2 text-sm text-gray-600">Drainase, sungai & irigasi, pengendalian banjir, embung, serta
                        konservasi air.</p>
                    <span class="mt-3 inline-block text-blue-600 text-sm group-hover:underline">Pelajari</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Detail per Bidang -->
    <section class="pb-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- Tata Ruang -->
            <div id="tataruang" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900">Bidang Tata Ruang</h2>
                    <p class="mt-2 text-gray-600">
                        Mengelola perencanaan dan pemanfaatan ruang wilayah agar pembangunan tertib, berkelanjutan, dan
                        sesuai RTRW/RDTR.
                    </p>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-900">Tugas Utama</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Penyusunan & evaluasi RTRW/RDTR.</li>
                                <li>Rekomendasi Kesesuaian Kegiatan Pemanfaatan Ruang.</li>
                                <li>Pengendalian pemanfaatan ruang & penertiban pelanggaran.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Layanan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Konsultasi pemanfaatan ruang & zoning.</li>
                                <li>Informasi peta tematik & koridor pembangunan.</li>
                                <li>Persetujuan prinsip tata ruang untuk perizinan OSS.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Contoh Laporan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Pemanfaatan lahan tidak sesuai peruntukan.</li>
                                <li>Bangunan melanggar garis sempadan jalan/sungai.</li>
                                <li>Reklame menutup pandangan atau melanggar zoning.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bina Marga -->
            <div id="binamarga" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900">Bidang Bina Marga</h2>
                    <p class="mt-2 text-gray-600">
                        Menangani pembangunan, pemeliharaan, dan peningkatan kualitas jalan serta jembatan untuk
                        konektivitas wilayah.
                    </p>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-900">Tugas Utama</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Pembangunan/rehab jalan & jembatan.</li>
                                <li>Pemeliharaan rutin, berkala, & darurat.</li>
                                <li>Manajemen lalu lintas: marka, rambu, guardrail.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Layanan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Pengaduan kerusakan jalan & jembatan.</li>
                                <li>Penanganan lubang, retak, dan amblas.</li>
                                <li>Koordinasi penutupan/rekayasa lalu lintas saat pekerjaan.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Contoh Laporan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Jalan berlubang/bergelombang.</li>
                                <li>Rambu/marka rusak atau hilang.</li>
                                <li>Jembatan retak, baut lepas, atau oprit amblas.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cipta Karya -->
            <div id="ciptakarya" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900">Bidang Cipta Karya</h2>
                    <p class="mt-2 text-gray-600">
                        Berfokus pada infrastruktur permukiman: bangunan gedung, sanitasi, persampahan, PJU, taman/ruang
                        publik.
                    </p>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-900">Tugas Utama</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Fasilitasi bangunan gedung & prasarana umum.</li>
                                <li>Pengelolaan persampahan & sanitasi lingkungan.</li>
                                <li>Pengelolaan PJU & ruang terbuka hijau.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Layanan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Pengaduan lampu jalan mati.</li>
                                <li>Perbaikan fasilitas taman, trotoar, halte.</li>
                                <li>Penanganan TPS/angkut sampah & sanitasi darurat.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Contoh Laporan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Lampu PJU padam/rusak.</li>
                                <li>Fasilitas taman/halte/trotoar rusak.</li>
                                <li>Tumpukan sampah & bau menyengat.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sumber Daya Air -->
            <div id="sda" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900">Bidang Sumber Daya Air</h2>
                    <p class="mt-2 text-gray-600">
                        Menangani pengelolaan drainase kota, sungai & saluran irigasi, pengendalian banjir, serta konservasi
                        sumber air.
                    </p>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-900">Tugas Utama</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Normalisasi & pemeliharaan saluran/drainase.</li>
                                <li>Pembangunan talud, bendung, dan embung.</li>
                                <li>Mitigasi banjir & operasi pompa.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Layanan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Penanganan sumbatan & sedimentasi.</li>
                                <li>Pembersihan gulma & sampah sungai.</li>
                                <li>Tanggap darurat genangan/banjir.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Contoh Laporan</h3>
                            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside space-y-1">
                                <li>Saluran tersumbat & meluap saat hujan.</li>
                                <li>Tanggul longsor/retak.</li>
                                <li>Pompa banjir tidak berfungsi.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </section>
@endsection
