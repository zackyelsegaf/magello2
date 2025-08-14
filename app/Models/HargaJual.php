<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaJual extends Model
{
    /** @use HasFactory<\Database\Factories\HargaJualFactory> */
    use HasFactory;

    protected $table = 'harga_juals';
    protected $guarded = ['id'];

    public function jenisHarga()
    {
        return $this->belongsTo(JenisHarga::class);
    }

    public function metodePenyesuaian()
    {
        return $this->belongsTo(MetodePenyesuaian::class);
    }

    public function nilaiPembulatan()
    {
        return $this->belongsTo(NilaiPembulatan::class);
    }

    public function sumberNilaiAsal()
    {
        return $this->belongsTo(SumberNilaiAsal::class);
    }

    public function unit()
    {
        return $this->belongsTo(UnitBarang::class);
    }

    public function items()
    {
        return $this->hasMany(HargaJualItem::class);
    }
}
