<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyesuaianBarang extends Model
{
    use HasFactory;

    protected $table = 'penyesuaian_barang';

    protected $fillable = [
        'no_penyesuaian',
        'tgl_penyesuaian',
        'akun_penyesuaian',
        'no_akun_penyesuaian',
        'deskripsi',
        'nilai_penyesuaian_check',
        'nilai_penyesuaian_check',
        'nilai_penyesuaian',
        'total_nilai_penyesuaian',
        'pengguna_penyesuaian',
        // 'catatan_pemeriksaan_check',
        // 'tindak_lanjut_check',
        // 'disetujui_check',
        // 'urgensi_check',
        // 'no_persetujuan',
    ];

    public function rincian()
    {
        return $this->hasMany(PenyesuaianBarangDetail::class);
    }

    public function detail()
    {
        return $this->hasOne(PenyesuaianBarangDetail::class, 'penyesuaian_barang_id', 'id');
    }


    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_penyesuaian', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_penyesuaian, strlen($prefix))) : 1;
            $model->no_penyesuaian = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_penyesuaian', $model->no_penyesuaian)->exists()) {
                $nextID++;
                $model->no_penyesuaian = $prefix . sprintf("%04d", $nextID);
            }
        });
    }
    
}
