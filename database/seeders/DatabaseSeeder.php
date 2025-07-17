<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BidangSeeder::class,
            UserSeeder::class,
            TimRutinSeeder::class,
            LaporanSeeder::class,
            TimNonRutinSeeder::class,
            LaporanRutinSeeder::class,
            LaporanNonRutinSeeder::class,
        ]);
    }
}
