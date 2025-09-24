<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    public function arsip()
    {
        return $this->morphMany(Arsip::class, 'arsipmultimenu');
    }

    protected static function booted()
    {
        static::deleting(function ($kapling) {
            $disk = config('filesystems.default', 'public');

            foreach ($kapling->arsip as $arsip) {
                if ($arsip->file_arsip && Storage::disk($disk)->exists($arsip->file_arsip)) {
                    Storage::disk($disk)->delete($arsip->file_arsip);
                }
                $arsip->delete();
            }

            $dir = "arsip/kapling/{$kapling->id}";
            if (Storage::disk($disk)->exists($dir)) {
                Storage::disk($disk)->deleteDirectory($dir);
            }
        });
    }
}
