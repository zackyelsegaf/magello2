<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBiayaKonsumen extends Model
{
    /** @use HasFactory<\Database\Factories\MasterBiayaKonsumenFactory> */
    use HasFactory;

    protected $table = 'master_biaya_konsumens';

    protected $guarded = ['id'];

    // Relasi ke Tipe Pembayaran
    public function tipePembayaran()
    {
        return $this->belongsTo(TipePembayaran::class);
    }

    // Relasi ke Kategori Pembayaran
    public function kategoriPembayaran()
    {
        return $this->belongsTo(KategoriPembayaran::class);
    }

    // Relasi Akun - Pembayaran Kustomer
    public function akunPembayaranKustomerDebit()
    {
        return $this->belongsTo(Akun::class, 'akun_pembayaran_kustomer_debit');
    }

    public function akunPembayaranKustomerKredit()
    {
        return $this->belongsTo(Akun::class, 'akun_pembayaran_kustomer_kredit');
    }

    // Relasi Akun - Piutang
    public function akunPiutangDebit()
    {
        return $this->belongsTo(Akun::class, 'akun_piutang_debit');
    }

    public function akunPiutangKredit()
    {
        return $this->belongsTo(Akun::class, 'akun_piutang_kredit');
    }

    // Relasi Akun - Closing Unit
    public function akunClosingUnitDebit()
    {
        return $this->belongsTo(Akun::class, 'akun_closing_unit_debit');
    }

    public function akunClosingUnitKredit()
    {
        return $this->belongsTo(Akun::class, 'akun_closing_unit_kredit');
    }
}
