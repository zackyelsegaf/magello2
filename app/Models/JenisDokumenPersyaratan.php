<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumenPersyaratan extends Model
{
    use HasFactory;

    protected $table = 'jenis_dokumen_persyaratan';

    protected $casts = [
        'urutan' => 'integer',
    ];

    public function dokumenBooking()
    {
        return $this->hasMany(DokumenBooking::class, 'jenis_dokumen_persyaratan_id');
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('urutan');
    }
}
