<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporans = [
            [
                'id' => 1,
                'judul' => 'Jalan Rusak di Jl. Sudirman',
                'deskripsi' => 'Jalan mengalami kerusakan parah dengan lubang besar di tengah jalan. Kondisi ini sangat berbahaya bagi pengendara sepeda motor dan mobil. Diperlukan perbaikan segera sebelum musim hujan.',
                'bidang_id' => 1, // Bidang Jalan dan Jembatan
                'nama_pelapor' => 'Bapak Hartono',
                'kontak_pelapor' => '081234567890',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'id' => 2,
                'judul' => 'Drainase Tersumbat di Perumahan Griya Indah',
                'deskripsi' => 'Saluran drainase di depan Perumahan Griya Indah tersumbat sampah dan sedimen. Saat hujan, air menggenang dan dapat menyebabkan banjir. Perlu pembersihan dan normalisasi saluran.',
                'bidang_id' => 2, // Bidang Drainase dan Irigasi
                'nama_pelapor' => 'Ibu Sari Dewi',
                'kontak_pelapor' => '081987654321',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'id' => 3,
                'judul' => 'Jembatan Penyeberangan Rusak',
                'deskripsi' => 'Jembatan penyeberangan orang di depan sekolah mengalami kerusakan pada bagian pegangan. Beberapa baut sudah longgar dan berkarat. Kondisi ini membahayakan keselamatan pejalan kaki.',
                'bidang_id' => 1, // Bidang Jalan dan Jembatan
                'nama_pelapor' => 'Bapak Agus Suprianto',
                'kontak_pelapor' => '082345678901',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'id' => 4,
                'judul' => 'Lampu Jalan Mati di Jl. Pahlawan',
                'deskripsi' => 'Beberapa lampu penerangan jalan di Jl. Pahlawan mati total. Kondisi jalan menjadi gelap dan rawan kecelakaan di malam hari. Mohon segera diperbaiki sistem kelistrikannya.',
                'bidang_id' => 1, // Bidang Jalan dan Jembatan
                'nama_pelapor' => 'Ibu Ratna Sari',
                'kontak_pelapor' => '083456789012',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'id' => 5,
                'judul' => 'Saluran Irigasi Bocor di Kelurahan Makmur',
                'deskripsi' => 'Saluran irigasi primer mengalami kebocoran di beberapa titik. Air irigasi banyak yang terbuang dan tidak sampai ke sawah petani. Perlu perbaikan struktur saluran.',
                'bidang_id' => 2, // Bidang Drainase dan Irigasi
                'nama_pelapor' => 'Pak Tani Sukamto',
                'kontak_pelapor' => '084567890123',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'id' => 6,
                'judul' => 'Trotoar Rusak di Depan Pasar',
                'deskripsi' => 'Trotoar di depan pasar tradisional mengalami kerusakan dengan paving block yang lepas dan tidak rata. Pejalan kaki kesulitan dan berisiko tersandung.',
                'bidang_id' => 1, // Bidang Jalan dan Jembatan
                'nama_pelapor' => 'Bapak Sumardi',
                'kontak_pelapor' => '085678901234',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'id' => 7,
                'judul' => 'Selokan Meluap di Jl. Melati',
                'deskripsi' => 'Selokan di sepanjang Jl. Melati sering meluap saat hujan deras. Air kotor menggenangi jalan dan masuk ke rumah-rumah warga. Perlu peningkatan kapasitas saluran.',
                'bidang_id' => 2, // Bidang Drainase dan Irigasi
                'nama_pelapor' => 'Ibu Lastri',
                'kontak_pelapor' => '086789012345',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'id' => 8,
                'judul' => 'Marka Jalan Pudar di Jl. Utama',
                'deskripsi' => 'Marka jalan di Jl. Utama sudah sangat pudar dan hampir tidak terlihat. Kondisi ini membahayakan pengendara karena tidak jelas pembagian lajur kendaraan.',
                'bidang_id' => 1, // Bidang Jalan dan Jembatan
                'nama_pelapor' => 'Bapak Rahman',
                'kontak_pelapor' => '087890123456',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
        ];

        DB::table('laporans')->insert($laporans);
    }
}
