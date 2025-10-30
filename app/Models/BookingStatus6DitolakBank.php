<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus6DitolakBank extends Model
{
    protected $table = 'status_booking_6';
    protected $guarded = [];

    protected $fillable = [
        'booking_id',
        'tanggal_ditolak',
        'alasan_ditolak',
        'file_ditolak'
    ];

    public function timeline()
    {
        return $this->morphMany(BookingTimeline::class, 'statusable');
    }

    public function arsipFiles()
    {
        return $this->morphMany(ArsipFile::class, 'arsipmultimenu');
    }
}
