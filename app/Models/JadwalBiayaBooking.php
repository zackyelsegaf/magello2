<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalBiayaBooking extends Model
{
    protected $table = 'jadwal_biaya_booking';
    protected $guarded = ['id']; 
    protected $casts = [
        'urutan' => 'integer',
    ];

    public function biayaBooking()
    {
        return $this->belongsTo(BiayaBooking::class, 'biaya_booking_id');
    }
}

