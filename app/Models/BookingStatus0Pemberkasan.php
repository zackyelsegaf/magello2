<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus0Pemberkasan extends Model
{
    protected $table = 'status_booking_0';
    protected $guarded = [];
    
    protected $fillable = [
        'booking_id',
        'tanggal_pemberkasan',
        'catatan_pemberkasan',
    ];

    public function timeline()
    {
        return $this->morphMany(BookingTimeline::class, 'statusable');
    }
}
