<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeAktivaTetapPajak extends Model
{
    use HasFactory;

    protected $table = 'tipe_aktiva_tetap_pajaks';

    protected $fillable = [
        'tipe_aktiva_tetap_pajak',
        'metode_penyusutan',
        'umur_perkiraan',
        'nilai_penyusutan',
    ];
}
