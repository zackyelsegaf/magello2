<?php

namespace App\Models\ModulUtama\Aktiva;

use App\Models\Akun;
use App\Models\Departemen;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModulUtama\Aktiva\AktivaTetapItem;
use App\Models\ModulUtama\Aktiva\TipeAktivaTetap;
use App\Models\ModulUtama\Aktiva\MetodePenyusutan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktivaTetap extends Model
{
    /** @use HasFactory<\Database\Factories\AktivaTetapFactory> */
    use HasFactory;

    protected $table = 'aktiva_tetaps';

    protected $guarded = ['id'];

    public function tipeAktiva()
    {
        return $this->belongsTo(TipeAktivaTetap::class, 'tipe_aktiva_id');
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function metodePenyusutan()
    {
        return $this->belongsTo(MetodePenyusutan::class, 'metode_penyusutan_id');
    }

    public function akunAktiva()
    {
        return $this->belongsTo(Akun::class, 'akun_aktiva_id');
    }

    public function akunAkumulasiPenyusutan()
    {
        return $this->belongsTo(Akun::class, 'akun_akumulasi_penyusutan_id');
    }

    public function akunBiayaPenyusutan()
    {
        return $this->belongsTo(AkunBiayaPenyusutan::class, 'akun_biaya_penyusutan_id');
    }

    public function items()
    {
        return $this->hasMany(AktivaTetapItem::class, 'aktiva_tetap_id');
    }
}
