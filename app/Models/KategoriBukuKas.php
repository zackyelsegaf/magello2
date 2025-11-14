<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBukuKas extends Model
{
    use HasFactory;

    protected $table = 'kategori_buku_kas';

    protected $fillable = [
        'nama_kategori',
        'tipe_id',
    ];

    public function tipe_kas(){
        return $this->belongsTo(TipeBukuKas::class, 'tipe_id');
    }
}
