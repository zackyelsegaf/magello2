<?php

namespace App\Models\BukuBesar;

use Illuminate\Database\Eloquent\Model;

class DetailPembayaranLainnya extends Model
{
    protected $table = 'detail_pembayaran_lainnya';
    protected $guarded = ['id'];

    public function entries() {
        return $this->belongsTo(PembayaranLainnya::class, 'pembayaran_id');
    }
}
