<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $fillable = ['nama', 'ketua_id'];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    public function timRutins()
    {
        return $this->hasMany(TimRutin::class);
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
    
}
