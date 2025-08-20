<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cluster;
use App\Models\RabRap;

class Kapling extends Model
{
    use HasFactory;

    protected $table = 'kapling';

    protected $fillable = [
        'cluster_id',
        'rap_rab_id',
        'tipe_model',
        'blok_kapling',
        'nomor_unit_kapling',
        'jumlah_lantai',
        'luas_tanah',
        'luas_bangunan',
        'harga_kapling',
        'spesifikasi',
        'status_penjualan',
        'status_pembangunan',
    ];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

    public function rapRab()   
    { 
        return $this->belongsTo(RabRap::class, 'rap_rab_id'); 
    }
}
