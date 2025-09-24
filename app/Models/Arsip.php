<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arsip_ffk';

    protected $fillable = [
        'nama_arsip',
        'nomor_arsip',
        'tanggal_arsip',
        'file_arsip',
        'keterangan_arsip',
        'original_name',
        'mime_type',
        'file_size',
    ];

    protected $casts = [
        'tanggal_arsip' => 'date',
        'file_size'     => 'integer',
    ];

    public function arsipmultimenu()
    {
        return $this->morphTo();
    }
}
