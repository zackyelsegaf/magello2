<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus7Mundur extends Model
{
    protected $table = 'status_booking_7';
    protected $guarded = [];
    
    protected $fillable = [
        'booking_id',
        'tanggal_mundur',
        'alasan_mundur',
    ];

    public function timeline()
    {
        return $this->morphMany(BookingTimeline::class, 'statusable');
    }
}
