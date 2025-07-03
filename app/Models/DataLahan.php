<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLahan extends Model
{
    /** @use HasFactory<\Database\Factories\DataLahanFactory> */
    use HasFactory;

    protected $table = 'data_lahans';
    protected $guarded = ['id'];

    // Relasi ke Cluster
    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    // Relasi ke Pemasok
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }

    public function subBiayaLahans()
    {
        return $this->hasMany(SubBiayaLahan::class);
    }
}
