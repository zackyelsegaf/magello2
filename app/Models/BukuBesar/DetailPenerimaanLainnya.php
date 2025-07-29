<?php

namespace App\Models\BukuBesar;

use Illuminate\Database\Eloquent\Model;

class DetailPenerimaanLainnya extends Model
{
    protected $table = 'detail_penerimaan_lainnya';
    protected $guarded = ['id'];

    public function entries() {
        return $this->belongsTo(PenerimaanLainnya::class, 'penerimaan_id');
    }
}
