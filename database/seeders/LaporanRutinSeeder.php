<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporanRutins = [
            [
                'id' => 1,
                'tim_rutin_id' => 1, // Tim Pemeliharaan Jalan Rutin
                'penanggung_jawab_id' => 4, // Ahmad Wijaya
                'tanggal' => now()->subDays(7)->format('Y-m-d'),
                'deskripsi' => 'Melakukan inspeksi rutin jalan di wilayah Kecamatan Pusat. Ditemukan beberapa kerusakan kecil pada permukaan aspal yang perlu diperbaiki. Dilakukan penambalan dengan aspal dingin pada 5 titik kerusakan.',
                'anggaran' => 2500000.00,
                'sumber_anggaran' => 'APBD Pemeliharaan Rutin',
                'catatan_anggaran' => 'Biaya material aspal dingin dan upah tenaga kerja',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'id' => 2,
                'tim_rutin_id' => 2, // Tim Inspeksi Jembatan
                'penanggung_jawab_id' => 4, // Ahmad Wijaya
                'tanggal' => now()->subDays(14)->format('Y-m-d'),
                'deskripsi' => 'Inspeksi bulanan jembatan di wilayah kerja. Pemeriksaan struktur, kebersihan saluran air jembatan, dan kondisi pagar pengaman. Semua jembatan dalam kondisi baik, dilakukan pembersihan kotoran dan sampah.',
                'anggaran' => 800000.00,
                'sumber_anggaran' => 'APBD Pemeliharaan Rutin',
                'catatan_anggaran' => 'Biaya tenaga kerja pembersihan dan transport',
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'id' => 3,
                'tim_rutin_id' => 3, // Tim Pemeliharaan Drainase
                'penanggung_jawab_id' => 5, // Rina Susanti
                'tanggal' => now()->subDays(10)->format('Y-m-d'),
                'deskripsi' => 'Pembersihan rutin saluran drainase di 15 titik. Pengangkatan sampah, sedimen, dan tumbuhan liar yang menyumbat aliran air. Dipasang kawat kasa untuk mencegah sampah masuk ke saluran.',
                'anggaran' => 1800000.00,
                'sumber_anggaran' => 'APBD Pemeliharaan Rutin',
                'catatan_anggaran' => 'Biaya tenaga kerja, alat kebersihan, dan material kawat kasa',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'id' => 4,
                'tim_rutin_id' => 4, // Tim Pemeliharaan Saluran Irigasi
                'penanggung_jawab_id' => 5, // Rina Susanti
                'tanggal' => now()->subDays(5)->format('Y-m-d'),
                'deskripsi' => 'Pemeliharaan saluran irigasi primer sepanjang 2 km. Pembersihan lumut dan tanaman air, perbaikan talud yang retak, dan pengecekan pintu air. Semua pintu air berfungsi dengan baik.',
                'anggaran' => 3200000.00,
                'sumber_anggaran' => 'APBD Pemeliharaan Rutin',
                'catatan_anggaran' => 'Biaya material semen, tenaga kerja, dan sewa alat',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'id' => 5,
                'tim_rutin_id' => 1, // Tim Pemeliharaan Jalan Rutin
                'penanggung_jawab_id' => 4, // Ahmad Wijaya
                'tanggal' => now()->subDays(2)->format('Y-m-d'),
                'deskripsi' => 'Pengecatan marka jalan di 3 ruas jalan utama. Pemasangan rambu-rambu lalu lintas yang rusak. Perbaikan lampu penerangan jalan yang mati di 8 titik.',
                'anggaran' => 4500000.00,
                'sumber_anggaran' => 'APBD Pemeliharaan Rutin',
                'catatan_anggaran' => 'Biaya cat marka, rambu lalu lintas, lampu LED, dan instalasi',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        DB::table('laporan_rutins')->insert($laporanRutins);
    }
}
