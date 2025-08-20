<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $table = 'cluster';

    protected $fillable = [
        'nama_cluster',
        'no_hp',
        'luas_tanah',
        'total_unit',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'alamat_cluster',
    ];

    public function dataLahans()
    {
        return $this->hasMany(DataLahan::class);
    }
}
