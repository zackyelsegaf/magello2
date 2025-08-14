<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\PembayaranFactory> */
    use HasFactory;
    protected $table = 'pembayarans';
    protected $guarded = ['id'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function tipe()
    {
        return $this->belongsTo(TipePembayaran::class, 'tipe_pembayaran_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    public function dokumen()
    {
        return $this->morphOne(Dokumen::class, 'dokumenable');
    }
}
