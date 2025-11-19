<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;
    
    protected $table = 'saran';

    protected $fillable = [
        'user_id',
        'nama',
        'kontak',
        'kategori',
        'judul',
        'isi_saran',
        'kepuasan',
        'follow_up',
        'status_tindak_lanjut',
        'ditindaklanjuti_pada',
    ];

    protected $casts = [
        'follow_up' => 'boolean',
        'kepuasan' => 'integer',
        'ditindaklanjuti_pada' => 'datetime',
    ];

    // Relasi ke user (kalau ada login warga)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
