<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembiayaanRincianAkun extends Model
{
    /** @use HasFactory<\Database\Factories\PembiayaanRincianAkunFactory> */
    use HasFactory;

    protected $table = 'pembiayaan_rincian_akuns';
    protected $guarded = ['id'];

    public function pembiayaanPesanan()
    {
        return $this->belongsTo(PembiayaanPesanan::class);
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
}
