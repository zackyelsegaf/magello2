<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PembayaranPembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_pembelian_detail';
    protected $fillable = [
        'pembayaran_pembelian_id',
        'akun_bank',
        'nilai_tukar',
        'mata_uang',
        'tgl_cek',
        'bayar_check',
        'no_cek',
        'jumlah_check',
        'saldo_bank',
        'no_faktur',
        'tgl_faktur',
        'jatuh_tempo',
        'pph_23',
        'diskon',
        'jumlah',
        'terhutang',
        'jumlah_pembayaran',
        'deskripsi_rincian',
        'alamat_pemasok',
        'deskripsi',
    ];

    public function rincian()
    {
        return $this->belongsTo(PembayaranPembelian::class);
    }
}
