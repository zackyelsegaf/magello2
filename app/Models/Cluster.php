<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use App\Models\DataLahan;

class Cluster extends Model
{
    use HasFactory;

    protected $table = 'cluster';

    protected $fillable = [
        'nama_cluster',
        'no_hp',
        'luas_tanah',
        'total_unit',
        'provinsi_code',
        'kota_code',
        'kecamatan_code',
        'kelurahan_code',
        'alamat_cluster',
    ];

    public function province() 
    { 
        return $this->belongsTo(Province::class, 'provinsi_code', 'code'); 
    }
    public function city()     
    { 
        return $this->belongsTo(City::class, 'kota_code', 'code');  
    }
    public function district() 
    { 
        return $this->belongsTo(District::class, 'kelurahan_code', 'code'); 
    }
    public function village()     
    { 
        return $this->belongsTo(Village::class, 'kecamatan_code', 'code');  
    }

    public function dataLahans()
    {
        return $this->hasMany(DataLahan::class);
    }
}
