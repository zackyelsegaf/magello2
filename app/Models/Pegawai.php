<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gender;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'nik_pegawai',
    //     'nama_pegawai',
    //     'tempat_lahir_pegawai',
    //     'tanggal_lahir_pegawai',
    //     'jenis_kelamin_pegawai',
    //     'agama_pegawai',
    //     'status_pernikahan_pegawai',
    //     'golongan_darah_pegawai',
    //     'email_pegawai',
    //     'no_telp_pegawai',
    //     'provinsi',
    //     'kota',
    //     'kecamatan',
    //     'kelurahan',
    //     'rt_pegawai',
    //     'rw_pegawai',
    //     'alamat_pegawai',
    //     'nama_bank_pegawai',
    //     'nomor_rekening_pegawai',
    //     'atas_nama_pegawai',
    //     'jenis_identitas_pegawai',
    //     'nomor_identitas_pegawai',
    //     'nama_ayah_pegawai',
    //     'nama_ibu_pegawai',
    //     'nama_kontak_darurat_pegawai',
    //     'no_telp_darurat_pegawai',
    //     'hubungan_pegawai',
    //     'status_pekerjaan_pegawai',
    //     'foto_pegawai',
    //     'tanggal_masuk_pegawai',
    //     'tanggal_keluar_pegawai',
    //     'twitter',
    //     'instagram',
    //     'youtube',
    //     'facebook',
    //     'linkedin',
    // ];

    public function gender() 
    { 
        return $this->belongsTo(Gender::class, 'jenis_kelamin_pegawai_id'); 
    }

    public function province() 
    { 
        return $this->belongsTo(Province::class, 'provinsi', 'code'); 
    }

    public function city()     
    { 
        return $this->belongsTo(City::class, 'kota', 'code');  
    }

    public function district() 
    { 
        return $this->belongsTo(District::class, 'kelurahan', 'code'); 
    }

    public function village()     
    { 
        return $this->belongsTo(Village::class, 'kecamatan', 'code');  
    }
}
