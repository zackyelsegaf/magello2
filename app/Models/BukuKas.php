<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKas extends Model
{
    use HasFactory;

    protected $table = 'buku_kas';

    protected $fillable = [
        'nama_kas',
        'keterangan',
        'saldo_awal',
        'no_rekening',
    ];
}
