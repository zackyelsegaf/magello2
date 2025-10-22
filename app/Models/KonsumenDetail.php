<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Province;
use App\Models\Cluster;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class KonsumenDetail extends Model
{
    use HasFactory;

    protected $table = 'konsumen_detail';

    // protected $casts = [
    //     'provinsi_code_2'  => 'string',
    //     'provinsi_code_3'  => 'string',
    //     'provinsi_code_4'  => 'string',
    //     'provinsi_code_5'  => 'string',
    //     'provinsi_code_6'  => 'string',
    //     'provinsi_code_7'  => 'string',
    //     'kota_code_2'      => 'string',
    //     'kota_code_3'      => 'string',
    //     'kota_code_4'      => 'string',
    //     'kota_code_5'      => 'string',
    //     'kota_code_6'      => 'string',
    //     'kota_code_7'      => 'string',
    //     'kecamatan_code_2' => 'string',
    //     'kecamatan_code_3' => 'string',
    //     'kecamatan_code_4' => 'string',
    //     'kecamatan_code_5' => 'string',
    //     'kecamatan_code_6' => 'string',
    //     'kecamatan_code_7' => 'string',
    //     'kelurahan_code_2' => 'string',
    //     'kelurahan_code_3' => 'string',
    //     'kelurahan_code_4' => 'string',
    //     'kelurahan_code_5' => 'string',
    //     'kelurahan_code_6' => 'string',
    //     'kelurahan_code_7' => 'string',

    // ];
    protected $guarded = [];

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

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

    public function province2()
    {
        return $this->belongsTo(Province::class, 'provinsi_code_2', 'code');
    }
    public function city2()
    {
        return $this->belongsTo(City::class,     'kota_code_2',     'code');
    }
    public function district2()
    {
        return $this->belongsTo(District::class, 'kecamatan_code_2', 'code');
    }
    public function village2()
    {
        return $this->belongsTo(Village::class,  'kelurahan_code_2', 'code');
    }

    public function province3()
    {
        return $this->belongsTo(Province::class, 'provinsi_code_3', 'code');
    }
    public function city3()
    {
        return $this->belongsTo(City::class,     'kota_code_3',     'code');
    }
    public function district3()
    {
        return $this->belongsTo(District::class, 'kecamatan_code_3', 'code');
    }
    public function village3()
    {
        return $this->belongsTo(Village::class,  'kelurahan_code_3', 'code');
    }

    public function province4()
    {
        return $this->belongsTo(Province::class, 'provinsi_code_4', 'code');
    }
    public function city4()
    {
        return $this->belongsTo(City::class,     'kota_code_4',     'code');
    }
    public function district4()
    {
        return $this->belongsTo(District::class, 'kecamatan_code_4', 'code');
    }
    public function village4()
    {
        return $this->belongsTo(Village::class,  'kelurahan_code_4', 'code');
    }

    public function province5()
    {
        return $this->belongsTo(Province::class, 'provinsi_code_5', 'code');
    }
    public function city5()
    {
        return $this->belongsTo(City::class,     'kota_code_5',     'code');
    }
    public function district5()
    {
        return $this->belongsTo(District::class, 'kecamatan_code_5', 'code');
    }
    public function village5()
    {
        return $this->belongsTo(Village::class,  'kelurahan_code_5', 'code');
    }

    public function province6()
    {
        return $this->belongsTo(Province::class, 'provinsi_code_6', 'code');
    }
    public function city6()
    {
        return $this->belongsTo(City::class,     'kota_code_6',     'code');
    }
    public function district6()
    {
        return $this->belongsTo(District::class, 'kecamatan_code_6', 'code');
    }
    public function village6()
    {
        return $this->belongsTo(Village::class,  'kelurahan_code_6', 'code');
    }

    public function province7()
    {
        return $this->belongsTo(Province::class, 'provinsi_code_7', 'code');
    }
    public function city7()
    {
        return $this->belongsTo(City::class,     'kota_code_7',     'code');
    }
    public function district7()
    {
        return $this->belongsTo(District::class, 'kecamatan_code_7', 'code');
    }
    public function village7()
    {
        return $this->belongsTo(Village::class,  'kelurahan_code_7', 'code');
    }

    public function status_pengajuan()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_pengajuan_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(TipePelanggan::class, 'pekerjaan_id');
    }

    public function pekerjaan_2()
    {
        return $this->belongsTo(TipePelanggan::class, 'pekerjaan_2_id');
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
