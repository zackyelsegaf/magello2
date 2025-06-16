<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaJualItem extends Model
{
    /** @use HasFactory<\Database\Factories\HargaJualItemFactory> */
    use HasFactory;
    protected $table = 'harga_jual_items';
    protected $guarded = ['id'];

    public function hargaJual()
    {
        return $this->belongsTo(HargaJual::class);
    }

    public function details()
    {
        return $this->hasMany(HargaJualItemDetail::class);
    }
}
