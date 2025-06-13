<?php

namespace App\Models\ModulUtama\Aktiva;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModulUtama\Aktiva\MetodePenyusutan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeAktivaTetapPajak extends Model
{
    /** @use HasFactory<\Database\Factories\TipeAktivaTetapPajakFactory> */
    use HasFactory;

    protected $table = 'tipe_aktiva_tetap_pajaks';

    protected $guarded = ['id'];

    public function metodePenyusutan()
    {
        return $this->belongsTo(MetodePenyusutan::class);
    }
}
