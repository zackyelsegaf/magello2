<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Province;
use App\Models\Cluster;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'konsumen';

    protected $casts = [
        'provinsi_code'  => 'string',
        'kota_code'      => 'string',
        'kecamatan_code' => 'string',
        'kelurahan_code' => 'string',
    ];
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'nama_konsumen'   ,
    //     'nik_konsumen'    ,
    //     'no_hp'           ,
    //     'status_pengajuan',
    //     'jenis_kelamin'   ,
    //     'cluster'         ,
    //     'provinsi'        ,
    //     'kota'            ,
    //     'kecamatan'       ,
    //     'kelurahan'       ,
    //     'alamat_konsumen' ,
    //     'pekerjaan'       ,
    //     'marketing'       ,
    //     'nik_pasangan'    ,
    //     'nama_pasangan'   ,
    //     'no_hp_pasangan'  ,
    // ];
    
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'jenis_kelamin_id');
    }

    public function province() 
    { 
        return $this->belongsTo(Province::class, 'provinsi_code', 'code'); 
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
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

    public function status_pengajuan()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_pengajuan_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(TipePelanggan::class, 'pekerjaan_id');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'konsumen_id');
    }

    public function kapling()
    {
        return $this->hasMany(Kapling::class, 'kapling_id');
    }
}

