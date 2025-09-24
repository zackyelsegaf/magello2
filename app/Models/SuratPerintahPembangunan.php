<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\SuratPerintahKerjaInternal;

class SuratPerintahPembangunan extends Model
{
    use HasFactory;
    protected $table = 'surat_perintah_pembangunan';
    protected $fillable = [
        'nomor_spp',
        'tanggal_spp',
        'catatan',
        'status_spp',
        'konsumen',
        'stok'
    ];

    public function spkInternals()
    {
        return $this->hasMany(SuratPerintahKerjaInternal::class, 'spp_id', 'id');
    }

    public function kaplings()
    {
        return $this->belongsToMany(Kapling::class, 'spp_kapling', 'spp_id', 'kapling_id')->withTimestamps();
    }

    // /** generate id */
    protected static function booted()
    {
        static::creating(function (self $model) {
            if (empty($model->tanggal_spp)) {
                $model->tanggal_spp = Carbon::now('Asia/Jakarta')->toDateString();
            }

            if (empty($model->nomor_spp)) {
                $model->nomor_spp = self::generateNomorSpp($model->tanggal_spp);
            }

            $model->konsumen = (int) !!$model->konsumen;
            $model->stok     = (int) !!$model->stok;
        });
    }

    /**
     */
    public static function generateNomorSpp(?string $tanggal): string
    {
        $date  = $tanggal ? Carbon::parse($tanggal, 'Asia/Jakarta') : Carbon::now('Asia/Jakarta');
        $year  = $date->format('Y');
        $month = $date->format('m');

        $countThisMonth = self::query()
            ->whereYear('tanggal_spp', $year)
            ->whereMonth('tanggal_spp', $month)
            ->lockForUpdate()
            ->count();

        $seq = str_pad($countThisMonth + 1, 4, '0', STR_PAD_LEFT);

        return 'SPP' . $year . $month . $seq;
    }
}
