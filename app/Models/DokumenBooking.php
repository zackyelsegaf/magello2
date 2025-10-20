<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenBooking extends Model
{
    use HasFactory;
    protected $table = 'dokumen_booking';
    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(BookingKavling::class);
    }

    public function jenisDokumenPersyaratan()
    {
        return $this->belongsTo(JenisDokumenPersyaratan::class, 'jenis_dokumen_persyaratan_id');
    }

    public function files()
    {
        return $this->morphMany(ArsipFile::class, 'arsipmultimenu');
    }
}
