<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;

    protected $table = 'pajak';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'nama',
    //     'kode_pajak',
    //     'nilai_persentase',
    //     'akun_pajak_penjualan',
    //     'akun_pajak_pembelian',
    //     'deskripsi',
    // ];
    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
