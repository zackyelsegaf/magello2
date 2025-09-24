<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Cluster;
use App\Models\RabRap;

class Fasum extends Model
{
    use HasFactory;

    protected $table = 'fasum';

    protected $fillable = [
        'cluster_id',
        'rap_rab_id',
        'tipe_model',
        'blok_fasum',
        'nomor_unit_fasum',
        'jumlah_lantai',
        'luas_tanah',
        'luas_bangunan',
        'harga_fasum',
        'status_penjualan',
        'status_pembangunan',
        'spesifikasi',
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
        static::deleting(function ($fasum) {
            $disk = config('filesystems.default', 'public');

            foreach ($fasum->arsip as $arsip) {
                if ($arsip->file_arsip && Storage::disk($disk)->exists($arsip->file_arsip)) {
                    Storage::disk($disk)->delete($arsip->file_arsip);
                }
                $arsip->delete();
            }

            $dir = "arsip/fasum/{$fasum->id}";
            if (Storage::disk($disk)->exists($dir)) {
                Storage::disk($disk)->deleteDirectory($dir);
            }
        });
    }
}
