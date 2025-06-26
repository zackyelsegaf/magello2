<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaJualItemDetail extends Model
{
    /** @use HasFactory<\Database\Factories\HargaJualItemDetailFactory> */
    use HasFactory;

    protected $table = 'harga_jual_item_details';
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(HargaJualItem::class, 'harga_jual_item_id');
    }

    public function jenisHarga()
    {
        return $this->belongsTo(JenisHarga::class, 'jenis_harga_id');
    }
}
