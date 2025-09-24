<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Pekerja;
use App\Models\Kapling;
use App\Models\SuratPerintahPembangunan;
use App\Models\SuratPerintahKerjaInternalListFee;

class SuratPerintahKerjaInternal extends Model
{
    use HasFactory;

    protected $table = 'surat_perintah_kerja';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'nomor_spk',
    //     'judul_spk',
    //     'tanggal_spk',
    //     'tanggal_mulai',
    //     'lama_pengerjaan',
    //     'status_spk',
    //     'siklus_pembayaran',
    //     'tipe_pembayaran',
    //     'fileupload',
    //     'dibuat_oleh',
    //     'disetujui_oleh',
    //     'pekerja_id',
    //     'spp_id'
    // ];

    protected static function booted()
    {
        static::creating(function (self $m) {
            if (empty($m->tanggal_spk)) {
                $m->tanggal_spk = now('Asia/Jakarta')->toDateString();
            }
            if (empty($m->nomor_spk)) {
                $m->nomor_spk = self::generateNomorSpk($m->tanggal_spk);
            }
        });
    }

    public static function generateNomorSpk(?string $tanggal): string
    {
        $date  = $tanggal ? \Carbon\Carbon::parse($tanggal, 'Asia/Jakarta') : now('Asia/Jakarta');
        $year  = $date->format('Y');
        $month = $date->format('m');

        $count = self::query()
            ->whereYear('tanggal_spk', $year)
            ->whereMonth('tanggal_spk', $month)
            ->lockForUpdate()
            ->count();

        return 'SPK' . $year . $month . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    }

    public function pekerja() 
    { 
        return $this->belongsTo(Pekerja::class, 'pekerja_id'); 
    }

    public function spp()     
    { 
        return $this->belongsTo(SuratPerintahPembangunan::class, 'spp_id'); 
    }

    public function fees()
    {
        return $this->hasMany(SuratPerintahKerjaInternalListFee::class, 'spk_id', 'id');
    }

    public function kaplings()
    {
        return $this->belongsToMany(Kapling::class, 'spk_kapling', 'spk_id', 'kapling_id')->withTimestamps();
    }
}
