<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus5Ajb extends Model
{
    protected $table = 'status_booking_5';
    protected $guarded = [];
    
    protected $fillable = [
        'booking_id',
        'tanggal_ajb',
        'catatan_ajb',
    ];

    public function timeline()
    {
        return $this->morphMany(BookingTimeline::class, 'statusable');
    }
}
