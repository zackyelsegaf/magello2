<?php

namespace App\Models\ModulUtama\Aktiva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeAktivaTetap extends Model
{
    /** @use HasFactory<\Database\Factories\TipeAktivaTetapFactory> */
    use HasFactory;

    protected $table = 'tipe_aktiva_tetaps';

    protected $guarded = ['id'];

    public function tipeAktivaPajak()
    {
        return $this->belongsTo(TipeAktivaTetapPajak::class, 'tipe_aktiva_tetap_pajak_id');
    }
}
