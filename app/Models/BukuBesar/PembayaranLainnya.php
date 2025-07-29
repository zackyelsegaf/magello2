<?php

namespace App\Models\BukuBesar;

use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Model;

class PembayaranLainnya extends Model
{
    protected $table = 'pembayaran_lainnya';
    protected $guarded = ['id'];

    public function entries() {
        return $this->hasMany(DetailPembayaranLainnya::class, 'pembayaran_id');
    }

    public function dokumen() {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }
}
