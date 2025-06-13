<?php

namespace App\Models\ModulUtama\Aktiva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunAkumulasiPenyusutan extends Model
{
    /** @use HasFactory<\Database\Factories\AkunAkumulasiPenyusutanFactory> */
    use HasFactory;

    protected $table = 'akun_akumulasi_penyusutans';

    protected $guarded = ['id'];
}
