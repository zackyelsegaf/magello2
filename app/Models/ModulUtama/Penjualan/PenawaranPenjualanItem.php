<?php

namespace App\Models\ModulUtama\Penjualan;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModulUtama\Penjualan\PenawaranPenjualan;

class PenawaranPenjualanItem extends Model
{
    protected $guarded = [];

    public function penawaran()
    {
        return $this->belongsTo(PenawaranPenjualan::class, 'penawaran_penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'item_id');
    }
    public function setHargaSatuanAttribute($value)
    {
        $this->attributes['harga_satuan'] = (int) str_replace(['.', ','], '', $value);
    }
}
