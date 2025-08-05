<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahBarangDetail extends Model
{
    protected $table = 'pindah_barang_detail';

    protected $fillable = [
        'pindah_barang_id',
        'no_barang',
        'deskripsi_barang',
        'kts_barang',
        'satuan',
        'pengguna_pindah',
    ];

    public function rincian()
    {
        return $this->belongsTo(PindahBarang::class);
    }
}
