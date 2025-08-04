<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Ketua Bidang
        User::create([
            'name' => 'Ketua Bidang Infrastruktur',
            'email' => 'ketua.infra@example.com',
            'password' => Hash::make('password123'),
            'role' => 'ketua_bidang',
        ]);

        User::create([
            'name' => 'Ketua Bidang Transportasi',
            'email' => 'ketua.trans@example.com',
            'password' => Hash::make('password123'),
            'role' => 'ketua_bidang',
        ]);


        User::create([
            'name' => 'Pegawai Tim A',
            'email' => 'pegawai.a@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pegawai',
        ]);

        User::create([
            'name' => 'Pegawai Tim B',
            'email' => 'pegawai.b@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pegawai',
        ]);
    }
}
