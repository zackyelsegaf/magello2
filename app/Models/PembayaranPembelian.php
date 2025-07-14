<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PembayaranPembelianDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranPembelian extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_pembelian';
    protected $fillable = [
        'no_pembayaran',
        'no_pemasok',
        'no_formulir',
        'no_persetujuan',
        'pemasok_pembayaran',
        'tgl_pembayaran',
        // 'deskripsi_faktur',
        'cek_kosong_check',
        // 'urgent_check',
        // 'catatan_pemeriksaan_check',
        'disetujui_check',
        'pajak_check',
        // 'termasuk_pajak_check',
        // 'deskripsi_1',
        // 'deskripsi_2',
        'status_pembayaran',
        'pengguna_pembayaran',
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
        return $this->hasMany(PembayaranPembelianDetail::class);
    }

    public function detail()
    {
        return $this->hasMany(PembayaranPembelianDetail::class, 'pembayaran_pembelian_id', 'id');

    }

    public function detail2()
    {
        return $this->hasOne(PembayaranPembelianDetail::class, 'pembayaran_pembelian_id', 'id');

    }

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_pembayaran', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_pembayaran, strlen($prefix))) : 1;
            $model->no_pembayaran = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_pembayaran', $model->no_pembayaran)->exists()) {
                $nextID++;
                $model->no_pembayaran = $prefix . sprintf("%04d", $nextID);
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
