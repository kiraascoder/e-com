<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tim Rutin untuk setiap bidang
        $timRutins = [
            // Bidang Jalan dan Jembatan
            [
                'id' => 1,
                'bidang_id' => 1,
                'nama_tim' => 'Tim Pemeliharaan Jalan Rutin',
                'penanggung_jawab_id' => 4, // Ahmad Wijaya
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'bidang_id' => 1,
                'nama_tim' => 'Tim Inspeksi Jembatan',
                'penanggung_jawab_id' => 4, // Ahmad Wijaya
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Bidang Drainase dan Irigasi
            [
                'id' => 3,
                'bidang_id' => 2,
                'nama_tim' => 'Tim Pemeliharaan Drainase',
                'penanggung_jawab_id' => 5, // Rina Susanti
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'bidang_id' => 2,
                'nama_tim' => 'Tim Pemeliharaan Saluran Irigasi',
                'penanggung_jawab_id' => 5, // Rina Susanti
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tim_rutins')->insert($timRutins);

        // Assign anggota ke tim rutin
        $timRutinUsers = [
            // Tim Pemeliharaan Jalan Rutin
            ['tim_rutin_id' => 1, 'user_id' => 6, 'created_at' => now(), 'updated_at' => now()], // Muhammad Rizki
            ['tim_rutin_id' => 1, 'user_id' => 7, 'created_at' => now(), 'updated_at' => now()], // Dewi Lestari
            ['tim_rutin_id' => 1, 'user_id' => 8, 'created_at' => now(), 'updated_at' => now()], // Andi Pratama

            // Tim Inspeksi Jembatan
            ['tim_rutin_id' => 2, 'user_id' => 9, 'created_at' => now(), 'updated_at' => now()], // Fitri Handayani
            ['tim_rutin_id' => 2, 'user_id' => 10, 'created_at' => now(), 'updated_at' => now()], // Dedi Kurniawan

            // Tim Pemeliharaan Drainase
            ['tim_rutin_id' => 3, 'user_id' => 6, 'created_at' => now(), 'updated_at' => now()], // Muhammad Rizki (multi-tim)
            ['tim_rutin_id' => 3, 'user_id' => 8, 'created_at' => now(), 'updated_at' => now()], // Andi Pratama (multi-tim)

            // Tim Pemeliharaan Saluran Irigasi
            ['tim_rutin_id' => 4, 'user_id' => 7, 'created_at' => now(), 'updated_at' => now()], // Dewi Lestari (multi-tim)
            ['tim_rutin_id' => 4, 'user_id' => 9, 'created_at' => now(), 'updated_at' => now()], // Fitri Handayani (multi-tim)
        ];

        DB::table('tim_rutin_user')->insert($timRutinUsers);
    }
}
