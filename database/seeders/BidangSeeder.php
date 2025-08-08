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
                'nama' => 'Bina Marga',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Cipta Karya',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'Sumber Daya Air',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama' => 'Tata Ruang',
                'ketua_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('bidangs')->insert($bidangs);
    }
}
