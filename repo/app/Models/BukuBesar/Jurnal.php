<?php

namespace App\Models\BukuBesar;

use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnal';
    protected $guarded = ['id'];

    public function entries() {
        return $this->hasMany(JurnalDetail::class);
    }

    public function dokumen() {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }
}
