<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FakturPembelianDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FakturPembelian extends Model
{
    use HasFactory;
    protected $table = 'faktur_pembelian';
    protected $fillable = [
        'no_faktur',
        'no_pemasok',
        'no_formulir',
        'no_persetujuan',
        'pemasok_faktur',
        'tgl_faktur',
        'deskripsi_faktur',
        'tindak_lanjut_check',
        'urgent_check',
        'catatan_pemeriksaan_check',
        'disetujui_check',
        'pajak_check',
        'termasuk_pajak_check',
        'deskripsi_1',
        'deskripsi_2',
        'status_faktur',
        'pengguna_faktur',
        'sub_total',
        'diskon_left',
        'total_diskon_right',
        'ppn_11_persen',
        'pajak_2',
        'jumlah_biaya',
        'jumlah',
        'gudang',
        'departemen',
        'proyek',
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
        return $this->hasMany(FakturPembelianDetail::class);
    }

    public function detail()
    {
        return $this->hasMany(FakturPembelianDetail::class, 'faktur_pembelian_id', 'id');

    }

    public function detail2()
    {
        return $this->hasOne(FakturPembelianDetail::class, 'faktur_pembelian_id', 'id');

    }

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_faktur', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_faktur, strlen($prefix))) : 1;
            $model->no_faktur = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_faktur', $model->no_faktur)->exists()) {
                $nextID++;
                $model->no_faktur = $prefix . sprintf("%04d", $nextID);
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
