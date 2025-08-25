<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimNonRutin extends Model
{
    protected $fillable = ['laporan_id', 'nama_tim', 'penanggung_jawab_id', 'deskripsi', 'bidang_id'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id');
    }

    public function anggota()
    {
        
        return $this->belongsToMany(
            User::class,
            'tim_non_rutin_user',
            'tim_non_rutin_id', 
            'user_id'
        )->withTimestamps();
    }
    public function laporanNonRutin()
    {
        return $this->hasOne(LaporanNonRutin::class);
    }
    public function anggotaNonRutin()
    {
        return $this->hasMany(TimNonRutinUsers::class);
    }
}
