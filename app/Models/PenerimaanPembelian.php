<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PenerimaanPembelianDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenerimaanPembelian extends Model
{
    use HasFactory;
    protected $table = 'penerimaan_pembelian';
    protected $fillable = [
        'no_penerimaan',
        'no_persetujuan',
        'no_pemasok',
        'no_formulir',
        'pemasok_penerimaan',
        'tgl_penerimaan',
        'deskripsi_penerimaan',
        'departemen',
        'gudang',
        'proyek',
        'tindak_lanjut_check',
        'urgent_check',
        'disetujui_check',
        'deskripsi_1',
        'catatan_pemeriksaan_check',
        'deskripsi_2',
        'status_penerimaan',
        'pengguna_penerimaan',
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
        return $this->hasMany(PenerimaanPembelianDetail::class);
    }

    public function detail()
    {
        return $this->hasMany(PenerimaanPembelianDetail::class, 'penerimaan_pembelian_id', 'id');

    }

    public function detail2()
    {
        return $this->hasOne(PenerimaanPembelianDetail::class, 'penerimaan_pembelian_id', 'id');

    }

    public function faktur() {
        return $this->hasMany(FakturPembelianDetail::class, 'no_penerimaan', 'no_penerimaan');
    }

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_penerimaan', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_penerimaan, strlen($prefix))) : 1;
            $model->no_penerimaan = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_penerimaan', $model->no_penerimaan)->exists()) {
                $nextID++;
                $model->no_penerimaan = $prefix . sprintf("%04d", $nextID);
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

