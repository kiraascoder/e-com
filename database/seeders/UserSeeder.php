<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        $users = [
            // ADMIN
            [
                'id' => 1,
                'name' => 'Administrator Sistem',
                'email' => 'admin@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // KETUA BIDANG
            [
                'id' => 2,
                'name' => 'Ir. Budi Santoso, M.T.',
                'email' => 'budi.santoso@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'ketua_bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Dr. Siti Rahayu, S.T., M.Eng.',
                'email' => 'siti.rahayu@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'ketua_bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // PENANGGUNG JAWAB
            [
                'id' => 4,
                'name' => 'Ahmad Wijaya, S.T.',
                'email' => 'ahmad.wijaya@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'penanggung_jawab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Rina Susanti, S.T.',
                'email' => 'rina.susanti@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'penanggung_jawab',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ANGGOTA
            [
                'id' => 6,
                'name' => 'Muhammad Rizki',
                'email' => 'muhammad.rizki@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Andi Pratama',
                'email' => 'andi.pratama@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Fitri Handayani',
                'email' => 'fitri.handayani@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'Dedi Kurniawan',
                'email' => 'dedi.kurniawan@dinaspu.go.id',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // MASYARAKAT (for testing public reports)
            [
                'id' => 11,
                'name' => 'Wahyu Setiawan',
                'email' => 'wahyu.setiawan@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'anggota', // Default role untuk warga
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'Maya Puspitasari',
                'email' => 'maya.puspita@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);

        // Update bidang dengan ketua_id
        DB::table('bidangs')->where('id', 1)->update(['ketua_id' => 2]); // Budi Santoso
        DB::table('bidangs')->where('id', 2)->update(['ketua_id' => 3]); // Siti Rahayu

    }
}
