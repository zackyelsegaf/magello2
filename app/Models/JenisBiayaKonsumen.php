<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BiayaBooking;

class JenisBiayaKonsumen extends Model
{
    use HasFactory;

    protected $table = 'jenis_biaya_konsumen';

    public function biayaBooking()
    {
        return $this->hasMany(BiayaBooking::class, 'jenis_biaya_id');
    }
}
