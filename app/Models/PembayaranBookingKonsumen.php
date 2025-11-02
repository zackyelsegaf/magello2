<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\ArsipFile;
use App\Models\PembayaranBookingKonsumenCicilan;

class PembayaranBookingKonsumen extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_konsumen';

    protected $fillable = [
        'booking_id',
        'jenis_biaya_konsumen_id',
        'akun_id',
        'nomor_referensi',
        'tanggal_pembayaran',
        'nominal_pembayaran',
        'catatan_pembayaran',
        'bukti_pembayaran',
        'is_approved',
        'approved_by',
        'approved_at',
        'changed_by',
        'created_by',
    ];

    protected $casts = [
        'is_approved'        => 'boolean',
        'approved_at'        => 'date', // ubah ke 'datetime' kalau kolomnya nanti datetime
        'nominal_pembayaran' => 'integer',
    ];

    // public static function generateNomorReferensi(?string $tanggal): string
    // {
    //     $date = $tanggal ? Carbon::parse($tanggal, 'Asia/Jakarta') : Carbon::now('Asia/Jakarta');
    //     $year = $date->format('Y');
    //     $month = $date->format('m');

    //     $countThisMonth = self::query()
    //         ->whereYear('tanggal_pembayaran', $year)
    //         ->whereMonth('tanggal_pembayaran', $month)
    //         ->count();

    //     $seq = str_pad($countThisMonth + 1, 4, '0', STR_PAD_LEFT);
    //     return 'INV' . $year . $month . $seq;
    // }

    protected static function booted()
    {
        static::creating(function (self $model) {
            if (empty($model->tanggal_pembayaran)) {
                $model->tanggal_pembayaran = Carbon::now('Asia/Jakarta')->toDateString();
            }

            if (empty($model->nomor_referensi)) {
                $model->nomor_referensi = self::generateNomorReferensi($model->tanggal_pembayaran);
            }
        });
    }

    /**
     * Generator INVYYYYMM####, urut per bulan berdasarkan tanggal_pembayaran.
     */
    public static function generateNomorReferensi(string $tanggal): string
    {
        $d = Carbon::parse($tanggal, 'Asia/Jakarta');
        $prefix = 'INV' . $d->format('Ym');

        $last = static::where('nomor_referensi', 'like', $prefix.'%')
            ->orderBy('nomor_referensi', 'desc')
            ->value('nomor_referensi');

        $seq = 1;
        if ($last) {
            $tail = substr($last, -4);
            $seq = ctype_digit($tail) ? ((int)$tail + 1) : 1;
        }

        return $prefix . str_pad((string)$seq, 4, '0', STR_PAD_LEFT);
    }

    public function booking()
    {
        return $this->belongsTo(BookingKavling::class, 'booking_id');
    }

    public function kapling()
    {
        return $this->belongsTo(Kapling::class, 'kapling_id');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBiayaKonsumen::class, 'jenis_biaya_konsumen_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function alokasiJadwal()
    {
        return $this->hasMany(PembayaranBookingKonsumenCicilan::class, 'pembayaran_id');
    }

    public function arsipFiles()
    {
        return $this->morphMany(ArsipFile::class, 'arsipmultimenu');
    }
}
