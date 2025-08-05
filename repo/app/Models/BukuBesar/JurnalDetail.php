<?php

namespace App\Models\BukuBesar;

use Illuminate\Database\Eloquent\Model;

class JurnalDetail extends Model
{
    protected $table = 'jurnal_detail';
    protected $guarded = ['id'];

    public function jurnal(){
        return $this->belongsTo(Jurnal::class, 'jurnal_id');
    }
}
