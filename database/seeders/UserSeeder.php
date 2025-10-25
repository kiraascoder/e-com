<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {

         /* =======================
         *  ADMIN SISTEM
         * ======================= */

        User::create([
            'name'          => 'Administrator Sistem',
            'nip'           => 12345678910,                        
            'email'         => 'admin@example.com',        
            'password'      => Hash::make('admin123'),     
            'role'          => 'admin',                    
            'alamat'        => 'Kantor Dinas Pekerjaan Umum & Penataan Ruang Kota Parepare',
            'no_telepon'    => '081234567800',
            'tanggal_lahir' => '1990-01-01',               
            'bidang_id'     => null,              
        ]);


        /* =======================
         *  KEPALA DINAS
         * ======================= */
        User::create([
            'name'          => 'H. BUDI RUSDI, S.Pi., M.M',
            'nip'           => '19701015 199703 1 009',
            'email'         => 'kepala.dinas@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'kepala_dinas',
            'alamat'        => 'Jl. Pembangunan No. 1, Kota Parepare',
            'no_telepon'    => '081234567890',
            'tanggal_lahir' => '1970-10-15',
            'bidang_id'     => null,
        ]);

        /* =======================
         *  KETUA BIDANG
         * ======================= */
        User::create([
            'name'          => 'WIDIN WIJAYA, S.Sos., MSP', // Bina Marga
            'nip'           => '19700620 200701 1 022',
            'email'         => 'widin.wijaya@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Bina Marga No. 1',
            'no_telepon'    => '081234567891',
            'tanggal_lahir' => '1970-06-20',
            'bidang_id'     => 1,
        ]);

        User::create([
            'name'          => 'H. SUHARDI, ST', // Cipta Karya
            'nip'           => '19710525 200312 1 005',
            'email'         => 'h.suhardi@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Cipta Karya No. 5',
            'no_telepon'    => '081234567892',
            'tanggal_lahir' => '1971-05-25',
            'bidang_id'     => 2,
        ]);

        User::create([
            'name'          => 'H. SURIANSYAH, S.ST., MSP', // Sumber Daya Air
            'nip'           => '19690819 201212 1 005',
            'email'         => 'h.suriansyah@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Sumber Daya Air No. 7',
            'no_telepon'    => '081234567893',
            'tanggal_lahir' => '1969-08-19',
            'bidang_id'     => 3,
        ]);

        User::create([
            'name'          => 'RAHMANYAH, SE., MM', // Tata Ruang
            'nip'           => '19691027 200801 1 008',
            'email'         => 'rahmanyah@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'ketua_bidang',
            'alamat'        => 'Jl. Tata Ruang No. 9',
            'no_telepon'    => '081234567894',
            'tanggal_lahir' => '1969-10-27',
            'bidang_id'     => 4,
        ]);

        /* =======================
         *  PEGAWAI - CIPTA KARYA
         * ======================= */
        User::create([
            'name'          => 'ISPRALAY BATULANGI, ST',
            'nip'           => '19780427 201001 1 018',
            'email'         => 'ispralay.batulangi@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Cipta Karya No.2',
            'no_telepon'    => '081234567811',
            'tanggal_lahir' => '1978-04-27',
            'bidang_id'     => 2,
        ]);
        User::create([
            'name'          => 'ANDI SUBHAM, ST',
            'nip'           => '19820404 201001 1 028',
            'email'         => 'andi.subham@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Cipta Karya No.3',
            'no_telepon'    => '081234567812',
            'tanggal_lahir' => '1982-04-04',
            'bidang_id'     => 2,
        ]);
        User::create([
            'name'          => 'KARTINI LAWATI, A.Md',
            'nip'           => '19771121 200502 2 004',
            'email'         => 'kartini.lawati@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Cipta Karya No.4',
            'no_telepon'    => '081234567813',
            'tanggal_lahir' => '1977-11-21',
            'bidang_id'     => 2,
        ]);
        User::create([
            'name'          => 'AGUNG BIGAMA, ST',
            'nip'           => '19891115 202202 1 036',
            'email'         => 'agung.bigama@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Cipta Karya No.5',
            'no_telepon'    => '081234567814',
            'tanggal_lahir' => '1989-11-15',
            'bidang_id'     => 2,
        ]);

        /* =======================
         *  PEGAWAI - BINA MARGA
         * ======================= */
        User::create([
            'name'          => 'IJHAN THARIQ, ST',
            'nip'           => '19771015 201001 1 022',
            'email'         => 'ijhan.thariq@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Bina Marga No.3',
            'no_telepon'    => '081234567821',
            'tanggal_lahir' => '1977-10-15',
            'bidang_id'     => 1,
        ]);
        User::create([
            'name'          => 'SITTI KHADIJAH MALIK, ST',
            'nip'           => '19780507 201504 2 001',
            'email'         => 'sitti.khadijah@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Bina Marga No.4',
            'no_telepon'    => '081234567822',
            'tanggal_lahir' => '1978-05-07',
            'bidang_id'     => 1,
        ]);
        User::create([
            'name'          => 'H. HIDAYASNI DJAFAR, ST',
            'nip'           => '19690526 200604 2 004',
            'email'         => 'hidayasni.djafar@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Bina Marga No.5',
            'no_telepon'    => '081234567823',
            'tanggal_lahir' => '1969-05-26',
            'bidang_id'     => 1,
        ]);
        User::create([
            'name'          => 'SABRING',
            'nip'           => '19790424 200801 2 015',
            'email'         => 'sabring@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Bina Marga No.6',
            'no_telepon'    => '081234567824',
            'tanggal_lahir' => '1979-04-24',
            'bidang_id'     => 1,
        ]);
        User::create([
            'name'          => 'AMBAR ARAS, ST',
            'nip'           => '19800423 201001 1 022',
            'email'         => 'ambar.aras@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Bina Marga No.7',
            'no_telepon'    => '081234567825',
            'tanggal_lahir' => '1980-04-23',
            'bidang_id'     => 1,
        ]);

        /* =======================
         *  PEGAWAI - SUMBER DAYA AIR
         * ======================= */
        User::create([
            'name'          => 'J. ARDIANSYAH T, ST',
            'nip'           => '19740603 200212 1 005',
            'email'         => 'ardiansyah.t@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.2',
            'no_telepon'    => '081234567831',
            'tanggal_lahir' => '1974-06-03',
            'bidang_id'     => 3,
        ]);
        User::create([
            'name'          => 'MULYADI, ST, MP',
            'nip'           => '19710717 201411 1 001',
            'email'         => 'mulyadi.stmp@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.3',
            'no_telepon'    => '081234567832',
            'tanggal_lahir' => '1971-07-17',
            'bidang_id'     => 3,
        ]);
        User::create([
            'name'          => 'SATRIANI, ST, MSP',
            'nip'           => '19820805 201503 2 010',
            'email'         => 'satriani@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.4',
            'no_telepon'    => '081234567833',
            'tanggal_lahir' => '1982-08-05',
            'bidang_id'     => 3,
        ]);
        User::create([
            'name'          => 'PANCA JAYA, ST',
            'nip'           => '19941028 201903 1 007',
            'email'         => 'panca.jaya@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.5',
            'no_telepon'    => '081234567834',
            'tanggal_lahir' => '1994-10-28',
            'bidang_id'     => 3,
        ]);
        User::create([
            'name'          => 'PANRAWAN, ST',
            'nip'           => '19920929 201903 2 001',
            'email'         => 'panrawan@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.6',
            'no_telepon'    => '081234567835',
            'tanggal_lahir' => '1992-09-29',
            'bidang_id'     => 3,
        ]);
        User::create([
            'name'          => 'MUHAMMAD IRSAN A. RAHMAN',
            'nip'           => '19751214 201001 1 005',
            'email'         => 'm.irsan.rahman@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.7',
            'no_telepon'    => '081234567836',
            'tanggal_lahir' => '1975-12-14',
            'bidang_id'     => 3,
        ]);
        User::create([
            'name'          => 'YULIANTIA ZAPUTRI',
            'nip'           => '19650807 201001 2 034',
            'email'         => 'yuliantia.zaputri@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.8',
            'no_telepon'    => '081234567837',
            'tanggal_lahir' => '1965-08-07',
            'bidang_id'     => 3,
        ]);
        User::create([
            'name'          => 'ZULFADLY, ST',
            'nip'           => '19790720 202521 1 023',
            'email'         => 'zulfadly@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. SDA No.9',
            'no_telepon'    => '081234567838',
            'tanggal_lahir' => '1979-07-20',
            'bidang_id'     => 3,
        ]);

        /* =======================
         *  PEGAWAI - TATA RUANG
         * ======================= */
        User::create([
            'name'          => 'KASTIAN TINGKAS, ST, MT',
            'nip'           => '19691027 201001 2 015',
            'email'         => 'kastian.tingkas@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.2',
            'no_telepon'    => '081234567841',
            'tanggal_lahir' => '1969-10-27',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'BRUHAN, ST.,M.Si',
            'nip'           => '19760524 200502 2 003',
            'email'         => 'bruhan@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.3',
            'no_telepon'    => '081234567842',
            'tanggal_lahir' => '1976-05-24',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'MUHAMMAD ROSDAN TAHIR, ST',
            'nip'           => '19771218 201001 1 006',
            'email'         => 'rosdan.tahir@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.4',
            'no_telepon'    => '081234567843',
            'tanggal_lahir' => '1977-12-18',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'AMRI, ST',
            'nip'           => '19790331 201001 1 016',
            'email'         => 'amri.st@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.5',
            'no_telepon'    => '081234567844',
            'tanggal_lahir' => '1979-03-31',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'E’VAVOANI A. AMD',
            'nip'           => '20040206 202014 2 001',
            'email'         => 'evavoani.amd@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.6',
            'no_telepon'    => '081234567845',
            'tanggal_lahir' => '2004-02-06',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'ARIANDA SYAHRITRI ARIFIN, ST',
            'nip'           => '19810330 201903 2 007',
            'email'         => 'arianda.syahritri@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.7',
            'no_telepon'    => '081234567846',
            'tanggal_lahir' => '1981-03-30',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'RIDHO DAN PUSPITA SARI, ST',
            'nip'           => '19900125 201903 2 002',
            'email'         => 'ridho.puspita@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.8',
            'no_telepon'    => '081234567847',
            'tanggal_lahir' => '1990-01-25',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'ISNOVITA ST',
            'nip'           => '19931107 201903 2 011',
            'email'         => 'isnovita@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.9',
            'no_telepon'    => '081234567848',
            'tanggal_lahir' => '1993-11-07',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'JUSBI’IN',
            'nip'           => '19850819 202521 1 029',
            'email'         => 'jusbiin@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.10',
            'no_telepon'    => '081234567849',
            'tanggal_lahir' => '1985-08-19',
            'bidang_id'     => 4,
        ]);
        User::create([
            'name'          => 'SURIANTI SAMAYA, SE',
            'nip'           => '19910502 202521 1 035',
            'email'         => 'surianti.samaya@example.com',
            'password'      => Hash::make('password123'),
            'role'          => 'pegawai',
            'alamat'        => 'Jl. Tata Ruang No.11',
            'no_telepon'    => '081234567850',
            'tanggal_lahir' => '1991-05-02',
            'bidang_id'     => 4,
        ]);
    }
}
