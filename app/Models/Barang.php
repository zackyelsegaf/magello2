<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RelationPerumahanBarang;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $guarded = ['id'];

    public function dokumen(){
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }

    public function satuan() {
        return $this->hasMany(Satuan::class, 'satuan_id');
    }
}
