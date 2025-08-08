<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AktivaTetapDetail;

class AktivaTetap extends Model
{
    use HasFactory;

    protected $table = 'aktiva_tetaps';

    protected $fillable = [
        'kode_aktiva',
        'tipe_aktiva',
        'departemen',
        'tgl_akuisisi',
        'deskripsi_aktiva',
        'tgl_penggunaan',
        'tahun',
        'bulan',
        'depresiasi',
        'metode_penyusutan',
        'akun_aktiva',
        'akun_akumulasi',
        'akun_biaya_penyusutan',
        'umur_perkiraan',
    ];

    public function rincian()
    {
        return $this->hasMany(AktivaTetapDetail::class);
    }

    public function detail()
    {
        return $this->hasMany(AktivaTetapDetail::class, 'aktiva_tetap_id', 'id');
    }

    public function detail2()
    {
        return $this->hasOne(AktivaTetapDetail::class, 'aktiva_tetap_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('kode_aktiva', 'desc')->first();
            $prefix = 'AKT';
            $nextID = $latestUser ? intval(substr($latestUser->kode_aktiva, strlen($prefix))) : 1;
            $model->kode_aktiva = $prefix . sprintf("%04d", $nextID);
            while (self::where('kode_aktiva', $model->kode_aktiva)->exists()) {
                $nextID++;
                $model->kode_aktiva = $prefix . sprintf("%04d", $nextID);
            }
        });
    }
}
