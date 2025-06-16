<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHarga extends Model
{
    /** @use HasFactory<\Database\Factories\JenisHargaFactory> */
    use HasFactory;

    protected $table = 'jenis_hargas';
    protected $guarded = ['id'];
}
