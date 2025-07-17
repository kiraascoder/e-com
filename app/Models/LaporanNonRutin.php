<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanNonRutin extends Model
{
    protected $fillable = [
        'tim_non_rutin_id',
        'laporan_id',
        'penanggung_jawab_id',
        'tanggal',
        'deskripsi',
        'anggaran',
        'sumber_anggaran',
        'catatan_anggaran'
    ];

    public function timNonRutin()
    {
        return $this->belongsTo(TimNonRutin::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id');
    }
}
