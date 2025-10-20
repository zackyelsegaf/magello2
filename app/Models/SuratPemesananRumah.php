<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BookingKavling;

class SuratPemesananRumah extends Model
{
    protected $table = 'surat_pemesanan_rumah';
    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(BookingKavling::class, 'booking_id');
    } 
}
