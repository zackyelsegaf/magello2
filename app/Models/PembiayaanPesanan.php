<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembiayaanPesanan extends Model
{
    /** @use HasFactory<\Database\Factories\PembiayaanPesananFactory> */
    use HasFactory;

    protected $table = 'pembiayaan_pesanans';
    protected $guarded = ['id'];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    // Relasi ke rincian akun (satu ke banyak)
    public function rincianAkuns()
    {
        return $this->hasMany(PembiayaanRincianAkun::class);
    }

    public function rincianBarang()
    {
        return $this->hasMany(PembiayaanRincianBarang::class);
    }

    public function dokumen()
    {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }
}
