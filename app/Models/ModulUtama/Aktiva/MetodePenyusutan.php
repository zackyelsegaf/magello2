<?php

namespace App\Models\ModulUtama\Aktiva;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModulUtama\Aktiva\TipeAktivaTetapPajak;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetodePenyusutan extends Model
{
    /** @use HasFactory<\Database\Factories\MetodePenyusutanFactory> */
    use HasFactory;


    protected $table = 'metode_penyusutans';

    protected $guarded = ['id'];

    public function tipeAktivaTetap()
    {
        return $this->hasMany(TipeAktivaTetapPajak::class);
    }
}
