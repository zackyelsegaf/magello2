<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanNomorSerialItem extends Model
{
    /** @use HasFactory<\Database\Factories\PencatatanNomorSerialItemFactory> */
    use HasFactory;

    protected $table = 'pencatatan_nomor_serial_items';
    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(PencatatanNomorSerialItem::class, 'pencatatan_nomor_serial_id');
    }   
}
