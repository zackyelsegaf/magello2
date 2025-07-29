<?php

namespace App\Models\BukuBesar;

use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Model;

class PenerimaanLainnya extends Model
{
    protected $table = 'penerimaan_lainnya';
    protected $guarded = ['id'];

    public function entries() {
        return $this->hasMany(DetailPenerimaanLainnya::class, 'penerimaan_id');
    }

    public function dokumen() {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }
}
