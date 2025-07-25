<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeAktivaTetap extends Model
{
    use HasFactory;

    protected $table = 'tipe_aktiva_tetaps';

    protected $fillable = [
        'tipe_aktiva_tetap',
        'tipe_aktiva_tetap_pajak',
        'metode_penyusutan',
        'umur_perkiraan',
        'nilai_penyusutan',
    ];
}
