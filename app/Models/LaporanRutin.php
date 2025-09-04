<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanRutin extends Model
{
    protected $fillable = [
        'tim_rutin_id',
        'penanggung_jawab_id',
        'tanggal',
        'deskripsi',
        'anggaran',
        'sumber_anggaran',
        'catatan_anggaran',
        'status_review'
    ];

    public function timRutin()
    {
        return $this->belongsTo(TimRutin::class);
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id');
    }
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
