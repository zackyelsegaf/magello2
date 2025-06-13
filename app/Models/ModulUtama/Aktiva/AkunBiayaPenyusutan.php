<?php

namespace App\Models\ModulUtama\Aktiva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunBiayaPenyusutan extends Model
{
    /** @use HasFactory<\Database\Factories\AkunBiayaPenyusutanFactory> */
    use HasFactory;
    protected $table = 'akun_biaya_penyusutans';

    protected $guarded = ['id'];
}
