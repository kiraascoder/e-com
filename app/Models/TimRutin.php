<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimRutin extends Model
{
    protected $fillable = ['nama_tim', 'bidang_id', 'penanggung_jawab_id'];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id');
    }

    public function anggota()
    {
        return $this->belongsToMany(User::class, 'tim_rutin_user');
    }

    public function laporanRutin()
    {
        return $this->hasMany(LaporanRutin::class);
    }
}
