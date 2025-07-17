<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimNonRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tim Non-Rutin dibentuk berdasarkan laporan tertentu
        $timNonRutins = [
            [
                'id' => 1,
                'laporan_id' => 1, // Jalan Rusak di Jl. Sudirman
                'nama_tim' => 'Tim Perbaikan Darurat Jl. Sudirman',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'id' => 2,
                'laporan_id' => 3, // Jembatan Penyeberangan Rusak
                'nama_tim' => 'Tim Perbaikan Jembatan Penyeberangan',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'id' => 3,
                'laporan_id' => 5, // Saluran Irigasi Bocor
                'nama_tim' => 'Tim Perbaikan Irigasi Kelurahan Makmur',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ];

        DB::table('tim_non_rutins')->insert($timNonRutins);

        // Assign anggota ke tim non-rutin
        $timNonRutinUsers = [
            // Tim Perbaikan Darurat Jl. Sudirman
            ['tim_non_rutin_id' => 1, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Ahmad Wijaya (PJ)
            ['tim_non_rutin_id' => 1, 'user_id' => 6, 'created_at' => now(), 'updated_at' => now()], // Muhammad Rizki
            ['tim_non_rutin_id' => 1, 'user_id' => 8, 'created_at' => now(), 'updated_at' => now()], // Andi Pratama
            ['tim_non_rutin_id' => 1, 'user_id' => 10, 'created_at' => now(), 'updated_at' => now()], // Dedi Kurniawan

            // Tim Perbaikan Jembatan Penyeberangan
            ['tim_non_rutin_id' => 2, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Ahmad Wijaya (PJ)
            ['tim_non_rutin_id' => 2, 'user_id' => 7, 'created_at' => now(), 'updated_at' => now()], // Dewi Lestari
            ['tim_non_rutin_id' => 2, 'user_id' => 9, 'created_at' => now(), 'updated_at' => now()], // Fitri Handayani

            // Tim Perbaikan Irigasi Kelurahan Makmur
            ['tim_non_rutin_id' => 3, 'user_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Rina Susanti (PJ)
            ['tim_non_rutin_id' => 3, 'user_id' => 7, 'created_at' => now(), 'updated_at' => now()], // Dewi Lestari
            ['tim_non_rutin_id' => 3, 'user_id' => 8, 'created_at' => now(), 'updated_at' => now()], // Andi Pratama
        ];

        DB::table('tim_non_rutin_user')->insert($timNonRutinUsers);
    }
}
