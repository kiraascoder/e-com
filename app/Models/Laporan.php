<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'alamat',
        'foto',
        'nama_pelapor',
        'kontak_pelapor',
        'bidang_id',
        'status_verifikasi',
        'tanggal_laporan',
        'pelapor_id',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function timNonRutin()
    {
        return $this->hasOne(TimNonRutin::class);
    }

    public function laporanNonRutin()
    {
        return $this->hasOne(LaporanNonRutin::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }
}
