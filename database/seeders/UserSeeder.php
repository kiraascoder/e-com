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
            'name'          => 'Admin Sistem',
            'email'         => 'admin@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'admin',
            'alamat'        => 'Jl. Merdeka No. 1',
            'no_telepon'    => '081234567890',
            'tanggal_lahir' => '1980-01-01',
            'bidang_id'     => null,
        ]);

        // Ketua Bidang Infrastruktur
        User::create([
            'name'          => 'Ketua Bina Marga',
            'email'         => 'ketua.binamarga@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Pembangunan No. 2',
            'no_telepon'    => '081234567891',
            'tanggal_lahir' => '1985-02-10',
            'bidang_id'     => 1,
        ]);

        // Ketua Bidang Transportasi
        User::create([
            'name'          => 'Ketua Bidang Cipta Karya',
            'email'         => 'ketua.ciptakarya@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Transportasi No. 3',
            'no_telepon'    => '081234567892',
            'tanggal_lahir' => '1987-03-15',
            'bidang_id'     => 2, // contoh bidang_id
        ]);

        // Ketua Bidang Transportasi
        User::create([
            'name'          => 'Ketua Bidang Sumber Daya Air',
            'email'         => 'ketua.sda@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Transportasi No. 3',
            'no_telepon'    => '081234567892',
            'tanggal_lahir' => '1987-03-15',
            'bidang_id'     => 3, // contoh bidang_id
        ]);
        // Ketua Bidang Transportasi
        User::create([
            'name'          => 'Ketua Bidang Tata Ruang',
            'email'         => 'ketua.tataruang@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Transportasi No. 3',
            'no_telepon'    => '081234567892',
            'tanggal_lahir' => '1987-03-15',
            'bidang_id'     => 4, // contoh bidang_id
        ]);

        // Pegawai Tim A
        User::create([
            'name'          => 'Pegawai Tim A',
            'email'         => 'pegawai.a@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tim Kerja No. 4',
            'no_telepon'    => '081234567893',
            'tanggal_lahir' => '1990-04-20',
            'bidang_id'     => 1,

        ]);

        // Pegawai Tim B
        User::create([
            'name'          => 'Pegawai Tim B',
            'email'         => 'pegawai.b@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tim Kerja No. 5',
            'no_telepon'    => '081234567894',
            'tanggal_lahir' => '1992-05-25',
            'bidang_id'     => 1,
        ]);

        // Warga
        User::create([
            'name'          => 'Hasdi',
            'email'         => 'hasdi@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'warga',
            'alamat'        => 'Jl. Warga Mandiri No. 6',
            'no_telepon'    => '081234567895',
            'tanggal_lahir' => '1995-06-30',
            'bidang_id'     => null,
        ]);
    }
}
