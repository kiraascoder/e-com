<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangs = [
            [
                'id' => 1,
                'nama' => 'Bidang Jalan dan Jembatan',
                'ketua_id' => null, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Bidang Drainase dan Irigasi',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'Bidang Bangunan Gedung',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama' => 'Bidang Tata Ruang',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama' => 'Bidang Sumber Daya Air',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('bidangs')->insert($bidangs);
    }
}
