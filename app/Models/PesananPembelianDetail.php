<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesananPembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesananPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'pesanan_pembelian_detail';
    protected $fillable = [
        'pesanan_pembelian_id',
        'no_barang',
        'deskripsi_barang',
        'kts_pesanan',
        'satuan',
        'harga_satuan',
        'diskon_barang',
        'pajak',
        'jumlah_total_harga',
        'kts_diterima',
        'departemen',
        'proyek',
        'gudang',
        'no_permintaan',
        'alamat_pemasok',
        'alamat_pengiriman',
        'tgl_ekspektasi',
        'syarat',
        'kirim_melalui',
        'fob',
        'nilai_tukar',  
        'tutup_check_detail',
        'uang_muka_check',
        'akun_uang_muka',
    ];

    public function rincian()
    {
        return $this->belongsTo(PesananPembelian::class);
    }
}
