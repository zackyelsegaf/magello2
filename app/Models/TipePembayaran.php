<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\TipePembayaranFactory> */
    use HasFactory;

    protected $table = 'tipe_pembayarans';
    protected $guarded = ['id'];
}
