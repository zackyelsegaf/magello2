<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesananPembelianDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesananPembelian extends Model
{
    use HasFactory;
    protected $table = 'pesanan_pembelian';
    protected $fillable = [
        'no_pesanan',
        'no_cnt_pesanan',
        'no_persetujuan',
        'pemasok_pesanan',
        'no_pemasok',
        'tgl_pesanan',
        'deskripsi_pesanan',
        'tindak_lanjut_check',
        'urgent_check',
        'catatan_pemeriksaan_check',
        'pajak_check',
        'termasuk_pajak_check',
        'tutup_check',
        'disetujui_check',
        'deskripsi_1',
        'deskripsi_2',
        'status_pesanan',
        'pengguna_pesanan',
        'sub_total',
        'diskon_left',
        'total_diskon_right',
        'ppn_11_persen',
        'pajak_2',
        'estimasi_biaya',
        'jumlah',
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
        return $this->hasMany(PesananPembelianDetail::class);
    }

    public function detail()
    {
        return $this->hasMany(PesananPembelianDetail::class, 'pesanan_pembelian_id', 'id');

    }

    public function detail2()
    {
        return $this->hasOne(PesananPembelianDetail::class, 'pesanan_pembelian_id', 'id');

    }

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_pesanan', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_pesanan, strlen($prefix))) : 1;
            $model->no_pesanan = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_pesanan', $model->no_pesanan)->exists()) {
                $nextID++;
                $model->no_pesanan = $prefix . sprintf("%04d", $nextID);
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
