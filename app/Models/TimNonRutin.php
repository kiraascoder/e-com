<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimNonRutin extends Model
{
    protected $fillable = ['laporan_id', 'nama_tim'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function anggota()
    {
        return $this->belongsToMany(User::class, 'tim_non_rutin_user');
    }

    public function laporanNonRutin()
    {
        return $this->hasOne(LaporanNonRutin::class);
    }
}
