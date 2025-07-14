<?php

namespace App\Models;

use App\Models\ReturPembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'retur_pembelian_detail';
    protected $fillable = [
        'retur_pembelian_id', 
        'no_barang',
        'deskripsi_barang',
        'kts_barang',
        'satuan',
        'harga_satuan',
        'diskon_barang',
        'kode_pajak',
        'jumlah_total_harga',
        'reserve_1',
        'reserve_2',
        'reserve_3',
        'alamat_pajak',
    ];
    
    public function rincian()
    {
        return $this->belongsTo(ReturPembelian::class);
    }
}
