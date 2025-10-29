<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus4AkadKredit extends Model
{
    protected $table = 'status_booking_4';
    protected $guarded = [];

    protected $fillable = [
        'booking_id',
        'tanggal_akad',
        'nama_akad',
        'plafond_akad',
    ];

    public function timeline()
    {
        return $this->morphMany(BookingTimeline::class, 'statusable');
    }
}
