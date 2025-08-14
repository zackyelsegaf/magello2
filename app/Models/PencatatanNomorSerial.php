<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanNomorSerial extends Model
{
    /** @use HasFactory<\Database\Factories\PencatatanNomorSerialFactory> */
    use HasFactory;

    protected $table = 'pencatatan_nomor_serials';
    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(PencatatanNomorSerialItem::class, 'pencatatan_nomor_serial_id');
    }
}
