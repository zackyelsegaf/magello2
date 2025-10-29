<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus2AnalisaBank extends Model
{
    protected $table = 'status_booking_2';
    protected $guarded = [];

    protected $fillable = [
        'booking_id',
        'tanggal_masuk_analisa_bank',
        'nama_bank_analisa',
        'catatan_analisa'
    ];

    public function timeline()
    {
        return $this->morphMany(BookingTimeline::class, 'statusable');
    }
}
