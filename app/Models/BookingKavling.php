<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\ArsipFile;
use App\Models\DokumenBooking;
use App\Models\Kapling;
use App\Models\Cluster;
use App\Models\StatusPengajuan;
use App\Models\TipePelanggan;
use App\Models\Gender;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use App\Models\Konsumen;
use App\Models\SuratPemesananRumah;

class BookingKavling extends Model
{
    use HasFactory;

    protected $table = 'booking_kavling';

    protected $fillable = [
        'kapling_id',
        'konsumen_id',
        'nomor_booking',
        'tanggal_booking',
        'metode_pembayaran',
        'nomor_spr',
        'status_pengajuan',
    ];

    public function files()
    {
        return $this->morphMany(ArsipFile::class, 'arsipmultimenu');
    }
    
    public function dokumen()
    {
        return $this->hasMany(DokumenBooking::class, 'booking_id');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'konsumen_id');
    }

    public function kapling()
    {
        return $this->belongsTo(Kapling::class, 'kapling_id');
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

    public function status_pengajuan()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_pengajuan_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(TipePelanggan::class, 'pekerjaan_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'jenis_kelamin_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'kota_code', 'code');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'kelurahan_code', 'code');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'kecamatan_code', 'code');
    }

    protected static function booted()
    {
        static::creating(function (self $model) {
            if (empty($model->tanggal_booking)) {
                $model->tanggal_booking = Carbon::now('Asia/Jakarta')->toDateString();
            }
            if (empty($model->nomor_booking)) {
                $model->nomor_booking = self::generateNomorBooking($model->tanggal_booking);
            }
        });

        static::deleting(function ($booking) {
            foreach ($booking->files as $file) {
                if ($file->file_arsip) {
                    Storage::disk($file->disk)->delete($file->file_arsip);
                }
                $file->delete();
            }

            foreach ($booking->dokumen as $dok) {
                foreach ($dok->files as $file) {
                    if ($file->file_arsip) {
                        Storage::disk($file->disk)->delete($file->file_arsip);
                    }
                    $file->delete();
                }
                $dok->delete();
            }

            // $dir  = "arsip/booking/{$booking->id}";
            // $disk = config('filesystems.default', 'public');
            // Storage::disk($disk)->deleteDirectory($dir);
        });
    }

    public static function generateNomorBooking(?string $tanggal): string
    {
        $date = $tanggal ? Carbon::parse($tanggal, 'Asia/Jakarta') : Carbon::now('Asia/Jakarta');
        $year = $date->format('Y');
        $month = $date->format('m');

        $countThisMonth = self::query()
            ->whereYear('tanggal_booking', $year)
            ->whereMonth('tanggal_booking', $month)
            ->count();

        $seq = str_pad($countThisMonth + 1, 4, '0', STR_PAD_LEFT);
        return 'BO' . $year . $month . $seq;
    }

    public function generateNomorSPR(): string
    {
        if (empty($this->nomor_booking)) {
            $tanggal = $this->tanggal_booking ?? Carbon::now('Asia/Jakarta')->toDateString();
            $this->tanggal_booking = $tanggal;
            $this->nomor_booking   = self::generateNomorBooking($tanggal);
        }

        $this->nomor_spr = 'SPR' . substr($this->nomor_booking, 2);

        $this->save();

        return $this->nomor_spr;
    }

    public function jenisBiayaBooking()
    {
        return $this->belongsTo(JenisBiayaKonsumen::class, 'jenis_biaya_id');
    }

    public function jadwalBiayaBooking()
    {
        return $this->hasMany(JadwalBiayaBooking::class, 'biaya_booking_id');
    }

    public function biayaBooking()
    {
        return $this->belongsTo(BiayaBooking::class, 'biaya_booking_id');
    }

    public function suratPemesananRumah()
    {
        return $this->belongsTo(SuratPemesananRumah::class, 'spr_id');
    }

    // protected static function booted()
    // {
    //     static::deleting(function ($booking) {
    //         foreach ($booking->files as $file) {
    //             if ($file->file_arsip) {
    //                 Storage::disk($file->disk)->delete($file->file_arsip);
    //             }
    //             $file->delete();
    //         }

    //         foreach ($booking->dokumen as $dok) {
    //             foreach ($dok->files as $file) {
    //                 if ($file->file_arsip) {
    //                     Storage::disk($file->disk)->delete($file->file_arsip);
    //                 }
    //                 $file->delete();
    //             }
    //             $dok->delete();
    //         }

    //         // $dir  = "arsip/booking/{$booking->id}";
    //         // $disk = config('filesystems.default', 'public');
    //         // Storage::disk($disk)->deleteDirectory($dir);
    //     });
    // }
}
