<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PembayaranBookingKonsumen;

class PembayaranBookingKonsumenCicilan extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_jadwal';

    protected $fillable = [
        'pembayaran_id',
        'jadwal_id',
        'amount_applied',
    ];

    protected $casts = [
        'amount_applied' => 'integer',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(PembayaranBookingKonsumen::class, 'pembayaran_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalBiayaBooking::class, 'jadwal_id');
    }
}
