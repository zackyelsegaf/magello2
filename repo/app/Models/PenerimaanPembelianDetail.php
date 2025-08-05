<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PenerimaanPembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenerimaanPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'penerimaan_pembelian_detail';
    protected $fillable = [
        'penerimaan_pembelian_id',
        'no_barang',
        'deskripsi_barang',
        'kts_penerimaan',
        'alamat_pemasok',
        'tgl_kirim',
        'kirim_melalui',
        'fob',
        'satuan',
        'no_pesanan',
        'no_permintaan',
        'kts_faktur',
        'harga_satuan',
        'diskon_barang',
        'kode_pajak',
        'jumlah_total_harga',
        'serial_number',
    ];

    public function rincian()
    {
        return $this->belongsTo(PenerimaanPembelian::class);
    }
}
