<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nip',
        'email',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'tanggal_lahir',
        'password',
        'bidang_id',
        'role'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function bidangKetua()
    {
        return $this->hasOne(Bidang::class, 'ketua_id');
    }

    public function timRutinDipegang()
    {
        return $this->hasMany(TimRutin::class, 'penanggung_jawab_id');
    }

    public function timRutin()
    {
        return $this->belongsToMany(TimRutin::class, 'tim_rutin_user');
    }

    public function timNonRutin()
    {
        return $this->belongsToMany(TimNonRutin::class, 'tim_non_rutin_user');
    }

    public function timNonRutinDipegang()
    {
        return $this->hasMany(TimNonRutin::class, 'penanggung_jawab_id');
    }
    public function laporanDibuat()
    {
        return $this->hasMany(Laporan::class, 'pelapor_id');
    }
}
