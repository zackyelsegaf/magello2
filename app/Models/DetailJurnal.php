<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailJurnal extends Model
{
    protected $table = 'detail_jurnal';
    protected $guarded = ['id'];

    public function jurnal(){
        return $this->belongsTo(Jurnal::class, 'jurnal_id');
    }
}
