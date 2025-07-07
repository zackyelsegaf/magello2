<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppKapling extends Model
{
    /** @use HasFactory<\Database\Factories\SppKaplingFactory> */
    use HasFactory;

    protected $table = 'spp_kaplings';
    protected $guarded = ['id'];

    public function spp()
    {
        return $this->belongsTo(SuratPerintahPembangunan::class, 'spp_id');
    }

    public function unitProperty()
    {
        return $this->belongsTo(UnitPropertie::class, 'unit_property_id');
    }

    // Optional: hanya untuk akses tipe kavling
    public function isKavling(): bool
    {
        return $this->unitProperty?->tipe_model === 1;
    }
}
