<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus3Sp3k extends Model
{
    protected $table = 'status_booking_3';
    protected $guarded = [];

    protected $fillable = [
        'booking_id',
        'nomor_sp3k',
        'tanggal_sp3k',
        'file_sp3k',
        'plafond_sp3k',
        'cicilan_sp3k',
        'tenor_sp3k',
        'bank_sp3k',
        'program_subsidi'
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
