<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FakturPembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FakturPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'faktur_pembelian_detail';
    protected $fillable = [
        'faktur_pembelian_id',
        'no_barang',
        'deskripsi_barang',
        'kts_faktur',
        'satuan',
        'harga_satuan',
        'diskon_barang',
        'kode_pajak',
        'jumlah_total_harga',
        'no_permintaan',
        'no_pesanan',
        'no_penerimaan',
        'reserve_1',
        'reserve_2',
        'reserve_3',
        'no_akun',
        'nama_akun',
        'jumlah',
        'catatan',
        'alokasi_barang_check',
        'alokasi_pemasok_check',
        'beban_tagihan_check',
        'tutup_check_detail',
        'pajak_inklusif_check',
        'nama_pemasok_detail',
        'no_faktur_detail',
        'tanggal_detail',
        'no_faktur_pajak',
        'alamat_pemasok',
        'tgl_kirim',
        'kirim_melalui',
        'fob',
        'nilai_tukar',
        'nilai_tukar_pajak',
        'tgl_pajak',
        'keterangan',
        'total_uang_muka',
        'tgl_uang_muka',
        'kode_pajak_uang_muka',
        'pajak_1',
        'pajak_2',
        'no_faktur_uang_muka',
        'no_po',
        'nilai_tukar_uang_muka',
        'nilai_tukar_pajak_uang_muka',
    ];

    public function rincian()
    {
        return $this->belongsTo(FakturPembelian::class);
    }
}
