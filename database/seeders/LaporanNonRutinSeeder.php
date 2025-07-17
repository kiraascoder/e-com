<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanNonRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporanNonRutins = [
            [
                'id' => 1,
                'tim_non_rutin_id' => 1, // Tim Perbaikan Darurat Jl. Sudirman
                'laporan_id' => 1, // Jalan Rusak di Jl. Sudirman
                'penanggung_jawab_id' => 4, // Ahmad Wijaya
                'tanggal' => now()->subDays(3)->format('Y-m-d'),
                'deskripsi' => 'Perbaikan darurat jalan rusak di Jl. Sudirman. Dilakukan penggalian area rusak, penambahan material sirtu, pemadatan, dan pengaspalan. Pekerjaan selesai dalam 2 hari dengan hasil yang memuaskan.',
                'anggaran' => 15000000.00,
                'sumber_anggaran' => 'APBD Perbaikan Darurat',
                'catatan_anggaran' => 'Biaya material aspal, sirtu, sewa alat berat, dan upah pekerja',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'id' => 2,
                'tim_non_rutin_id' => 2, // Tim Perbaikan Jembatan Penyeberangan
                'laporan_id' => 3, // Jembatan Penyeberangan Rusak
                'penanggung_jawab_id' => 4, // Ahmad Wijaya
                'tanggal' => now()->subDays(5)->format('Y-m-d'),
                'deskripsi' => 'Perbaikan jembatan penyeberangan orang yang rusak. Penggantian pegangan yang berkarat, pengetatan baut, pengecatan ulang struktur besi, dan pemasangan anti slip pada lantai jembatan.',
                'anggaran' => 8500000.00,
                'sumber_anggaran' => 'APBD Perbaikan Darurat',
                'catatan_anggaran' => 'Biaya material besi, cat anti karat, anti slip, dan tenaga kerja',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'id' => 3,
                'tim_non_rutin_id' => 3, // Tim Perbaikan Irigasi Kelurahan Makmur
                'laporan_id' => 5, // Saluran Irigasi Bocor
                'penanggung_jawab_id' => 5, // Rina Susanti
                'tanggal' => now()->subDays(2)->format('Y-m-d'),
                'deskripsi' => 'Perbaikan saluran irigasi yang bocor di Kelurahan Makmur. Dilakukan pekerjaan waterproofing, perbaikan struktur beton yang retak, dan pemasangan joint sealant pada sambungan saluran.',
                'anggaran' => 12000000.00,
                'sumber_anggaran' => 'APBD Rehabilitasi Irigasi',
                'catatan_anggaran' => 'Biaya material beton, waterproofing, joint sealant, dan upah pekerja spesialis',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        DB::table('laporan_non_rutins')->insert($laporanNonRutins);
    }
}
