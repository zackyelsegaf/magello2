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
        'disetujui_check',
        'deskripsi_1',
        'catatan_pemeriksaan_check',
        'deskripsi_2',
        'status_permintaan',
        'pengguna_permintaan',
        'proyek',
        'gudang',
        'departemen',
        'no_persetujuan',
    ];

    public function rincian()
    {
        return $this->hasMany(PermintaanPembelianDetail::class);
    }

    public function detail()
    {
        return $this->hasMany(PermintaanPembelianDetail::class, 'permintaan_pembelian_id', 'id');
    }

    public function detail2()
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

            if ($model->disetujui_check == 1) {
                $latestPersetujuan = self::orderBy('no_persetujuan', 'desc')->whereNotNull('no_persetujuan')->first();
                $prefixPersetujuan = 'SPV';
                $nextPersetujuan = $latestPersetujuan ? intval(substr($latestPersetujuan->no_persetujuan, strlen($prefixPersetujuan))) : 1;
                $model->no_persetujuan = $prefixPersetujuan . sprintf("%04d", $nextPersetujuan);

                while (self::where('no_persetujuan', $model->no_persetujuan)->exists()) {
                    $nextPersetujuan++;
                    $model->no_persetujuan = $prefixPersetujuan . sprintf("%04d", $nextPersetujuan);
                }
            }
        });
    }

    public static function generateNoPersetujuan()
    {
        $latest = self::orderBy('no_persetujuan', 'desc')->whereNotNull('no_persetujuan')->first();
        $prefix = 'SPV';
        $next = $latest ? intval(substr($latest->no_persetujuan, strlen($prefix))) + 1 : 1;

        $newCode = $prefix . sprintf('%04d', $next);

        while (self::where('no_persetujuan', $newCode)->exists()) {
            $next++;
            $newCode = $prefix . sprintf('%04d', $next);
        }

        return $newCode;
    }

}
