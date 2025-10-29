<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus1Proses extends Model
{
    protected $table = 'status_booking_1';
    protected $guarded = [];

    protected $fillable = [
        'booking_id',
        'tanggal_masuk_bank',
        'nama_bank_proses',
        'catatan_proses',
    ];

    public function timeline()
    {
        return $this->morphMany(BookingTimeline::class, 'statusable');
    }
}
