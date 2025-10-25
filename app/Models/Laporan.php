<?php
// app/Models/Laporan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Laporan extends Model
{
    use HasFactory, SoftDeletes;
    public const KATEGORI  = ['jalan', 'trotoar', 'lampu_jalan', 'taman_kota', 'saluran_air', 'lainnya'];
    public const TINGKAT   = ['ringan', 'sedang', 'berat'];
    public const VERIFIKASI = ['pending', 'diterima', 'ditolak'];
    public const PENANGANAN = ['menunggu', 'diproses', 'selesai', 'ditunda'];

    protected $fillable = [
        'kode_laporan',
        'judul',
        'deskripsi',
        'kategori_fasilitas',
        'jenis_kerusakan',
        'alamat',
        'kecamatan',
        'kelurahan',
        'latitude',
        'longitude',
        'foto',
        'pelapor_id',
        'is_anonim',
        'nama_pelapor',
        'kontak_pelapor',
        'status_verifikasi',
        'status_penanganan',
        'tanggal_laporan',
        'tanggal_selesai',
        'bidang_id',
    ];

    protected $casts = [
        'is_anonim'        => 'boolean',
        'latitude'         => 'float',
        'longitude'        => 'float',
        'tanggal_laporan'  => 'datetime',
        'tanggal_selesai'  => 'datetime',
        'deleted_at'       => 'datetime',
    ];

    // Auto-append helper attributes
    protected $appends = ['foto_url', 'koordinat'];

    // ====== Relasi ======
    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? Storage::disk('public')->url($this->foto) : null;
    }

    public function getKoordinatAttribute(): ?array
    {
        if (is_null($this->latitude) || is_null($this->longitude)) {
            return null;
        }
        return ['lat' => $this->latitude, 'lng' => $this->longitude];
    }

    // ====== Scope Cepat ======
    public function scopeKategori($q, string $kategori)
    {
        return $q->where('kategori_fasilitas', $kategori);
    }

    public function scopeWilayah($q, ?string $kecamatan = null, ?string $kelurahan = null)
    {
        return $q
            ->when($kecamatan, fn($qq) => $qq->where('kecamatan', $kecamatan))
            ->when($kelurahan, fn($qq) => $qq->where('kelurahan', $kelurahan));
    }

    public function scopeStatus($q, ?string $verifikasi = null, ?string $penanganan = null)
    {
        return $q
            ->when($verifikasi, fn($qq) => $qq->where('status_verifikasi', $verifikasi))
            ->when($penanganan, fn($qq) => $qq->where('status_penanganan', $penanganan));
    }

    public function verifikasiTerima(): void
    {
        $this->update(['status_verifikasi' => 'diterima']);
    }

    public function verifikasiTolak(): void
    {
        $this->update(['status_verifikasi' => 'ditolak']);
    }

    public function mulaiProses(): void
    {
        $this->update(['status_penanganan' => 'diproses']);
    }

    public function tandaiSelesai(): void
    {
        $this->update([
            'status_penanganan' => 'selesai',
            'tanggal_selesai'   => now(),
        ]);
    }
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->kode_laporan)) {
                $model->kode_laporan = 'LPR-' . now()->format('Ymd') . '-' . str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            }
            if ($model->is_anonim) {
                $model->nama_pelapor   = 'Anonim';
                $model->kontak_pelapor = null;
                $model->pelapor_id     = null;
            }
        });
    }

public function getRouteKeyName(): string { return 'kode_laporan'; }

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
