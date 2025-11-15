<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBukuKas extends Model
{
    use HasFactory;

    protected $table = 'transaksi_buku_kas';

    protected $fillable = [
        'buku_kas_id',
        'kategori_id',
        'tipe_id',
        'nominal',
        'tanggal',
        'referensi',
        'keterangan',
    ];

    public function buku_kas(){
        return $this->belongsTo(BukuKas::class, 'buku_kas_id');
    }

    public function kategori_kas(){
        return $this->belongsTo(KategoriBukuKas::class, 'kategori_id');
    }

    public function tipe_kas(){
        return $this->belongsTo(TipeBukuKas::class, 'tipe_id');
    }
}
