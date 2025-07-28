<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivaTetap extends Model
{
    use HasFactory;

    protected $table = 'aktiva_tetaps';

    protected $fillable = [
        'kode_aktiva',
        'tipe_aktiva',
        'deskripsi',
        'departemen',
        'penyusutan',
        'tanggal_akuisisi',
        'tanggal_penggunaan',
    ];
}
