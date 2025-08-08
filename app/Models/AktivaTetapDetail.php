<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AktivaTetap;

class AktivaTetapDetail extends Model
{
    use HasFactory;

    protected $table = 'aktiva_tetap_details';

    protected $fillable = [
        'aktiva_tetap_id',
        'no_akun',
        'tanggal',
        'deskripsi',
        'nilai',
        'rekonsiliasi_check',
        'biaya_aktiva',
        'nilai_penyusutan',
        'nilai_buku',
        'nilai_sisa',
        'memo',
    ];

    public function rincian()
    {
        return $this->belongsTo(AktivaTetap::class);
    }
}
