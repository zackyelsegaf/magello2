<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barang';

    protected $fillable = [
        'gudang_id',
        'barang_id',
        'jumlah'
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
