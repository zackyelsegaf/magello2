<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTimeline extends Model
{
    protected $table = 'timeline_booking';
    protected $guarded = [];
    protected $fillable = [
        'booking_id', 
        'status_code', 
        'statusable_id', 
        'statusable_type', 
        'notes', 
        'changed_by', 
        'changed_at', 
        'is_current'
    ];

    public function statusable()
    {
        return $this->morphTo();
    }
    
    public function arsipFiles()
    {
        return $this->morphMany(ArsipFile::class, 'arsipmultimenu');
    }
}
