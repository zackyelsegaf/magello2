<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembiayaanRincianBarang extends Model
{
    /** @use HasFactory<\Database\Factories\PembiayaanRincianBarangFactory> */
    use HasFactory;

    protected $table = 'pembiayaan_rincian_barangs';
    protected $guarded = ['id'];

    public function pembiayaanPesanan()
    {
        return $this->belongsTo(PembiayaanPesanan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
