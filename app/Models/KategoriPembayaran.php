<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriPembayaranFactory> */
    use HasFactory;

    protected $table = 'kategori_pembayarans';

    protected $guarded = ['id'];
}
