<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBiayaLahan extends Model
{
    /** @use HasFactory<\Database\Factories\SubBiayaLahanFactory> */
    use HasFactory;

    protected $table = 'sub_biaya_lahans';
    protected $guarded = ['id'];

    public function kreditJadwal()
    {
        return $this->hasMany(SubBiayaLahanKredit::class);
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id'); // kas/bank, hanya untuk tunai
    }

    /**
     * Relasi ke lahan induk
     */
    public function dataLahan()
    {
        return $this->belongsTo(DataLahan::class);
    }

    /**
     * Relasi ke master kategori biaya (misal: Cut & Field, IMB, dsb.)
     */
    public function masterBiayaLahan()
    {
        return $this->belongsTo(MasterBiayaLahan::class);
    }
}
