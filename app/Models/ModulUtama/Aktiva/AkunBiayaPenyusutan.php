<?php

namespace App\Models\ModulUtama\Aktiva;

use App\Models\Akun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AkunBiayaPenyusutan extends Model
{
    /** @use HasFactory<\Database\Factories\AkunBiayaPenyusutanFactory> */
    use HasFactory;
    protected $table = 'akun_biaya_penyusutans';

    protected $guarded = ['id'];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
