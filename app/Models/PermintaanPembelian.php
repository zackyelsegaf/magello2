<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PermintaanPembelianDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermintaanPembelian extends Model
{
    use HasFactory;
    protected $table = 'permintaan_pembelian';
    protected $fillable = [
        'no_permintaan',
        'tgl_permintaan',
        'deskripsi_permintaan',
        'tindak_lanjut_check',
        'urgent_check',
        'deskripsi_1',
        'catatan_pemeriksaan_check',
        'deskripsi_2',
        'status_permintaan',
        'pengguna_permintaan',
        'proyek',
        'gudang',
        'departemen',
    ];

    public function rincian()
    {
        return $this->hasMany(PermintaanPembelianDetail::class);
    }

    public function detail()
    {
        return $this->hasOne(PermintaanPembelianDetail::class, 'permintaan_pembelian_id', 'id');
    }

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_permintaan', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_permintaan, strlen($prefix))) : 1;
            $model->no_permintaan = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_permintaan', $model->no_permintaan)->exists()) {
                $nextID++;
                $model->no_permintaan = $prefix . sprintf("%04d", $nextID);
            }
        });
    }
}
