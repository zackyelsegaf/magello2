<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JenisBiayaKonsumen;

class BiayaBooking extends Model
{
    protected $table = 'biaya_booking'; 
    protected $fillable = [
        'booking_id',
        'jenis_biaya_id',
        'nominal_biaya',
        'use_diskon',
        'use_jadwal',
        'nominal_diskon',
    ];
    protected $casts = [
        'use_diskon' => 'boolean',
        'use_jadwal' => 'boolean',
    ];

    public function booking()
    {
        return $this->belongsTo(BookingKavling::class, 'booking_id');
    }

    public function jenisBiayaBooking()
    {
        return $this->belongsTo(JenisBiayaKonsumen::class, 'jenis_biaya_id');
    }

    public function jadwalBiayaBooking()
    {
        return $this->hasMany(JadwalBiayaBooking::class, 'biaya_booking_id');
    }
}

