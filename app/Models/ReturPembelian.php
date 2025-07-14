<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReturPembelianDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturPembelian extends Model
{
    use HasFactory;
    protected $table = 'retur_pembelian';
    protected $fillable = [
        'no_retur',
        'tgl_retur',
        'no_formulir',
        'no_pemasok',
        'pemasok_retur', 
        'departemen',
        'gudang',
        'proyek',
        'sub_total',
        'ppn_11_persen',
        'pajak_2',
        'jumlah',
        'status_retur', 
        'pengguna_retur', 
        'pajak_check',
        'termasuk_pajak_check',
        'disetujui_check',
        'deskripsi',
        'no_faktur',
        'nilai_tukar_pajak',
        'nilai_tukar',
        'fileupload_1',
        'fileupload_2',
        'fileupload_3',
        'fileupload_4',
        'fileupload_5',
        'fileupload_6',
        'fileupload_7', 
        'fileupload_8',
    ];

    public function rincian()
    {
        return $this->hasMany(ReturPembelianDetail::class);
    }

    public function detail()
    {
        return $this->hasMany(ReturPembelianDetail::class, 'retur_pembelian_id', 'id');

    }

    public function detail2()
    {
        return $this->hasOne(ReturPembelianDetail::class, 'retur_pembelian_id', 'id');

    }

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_retur', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_retur, strlen($prefix))) : 1;
            $model->no_retur = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_retur', $model->no_retur)->exists()) {
                $nextID++;
                $model->no_retur = $prefix . sprintf("%04d", $nextID);
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
