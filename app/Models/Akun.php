<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ModulUtama\Aktiva\AkunBiayaPenyusutan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akun';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'no_akun',
    //     'tipe_id',
    //     'nama_akun_indonesia',
    //     'nama_akun_inggris',
    //     'mata_uang',
    //     'sub_akun_check',
    //     'sub_akun',
    //     'saldo_akun',
    //     'tanggal',
    //     'dihentikan',
    // ];

    public function parent()
    {
        return $this->belongsTo(Akun::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Akun::class, 'parent_id');
    }

    public function tipe()
    {
        return $this->belongsTo(TipeAkun::class, 'tipe_id');
    }

    public function mataUang()
    {
        return $this->belongsTo(MataUang::class, 'mata_uang_id');
    }

    public function anggaranAkuns(): HasMany
    {
        return $this->hasMany(AnggaranAkun::class, 'akun_id');
    }

    public function journalEntries()
    {
        return $this->hasMany(JurnalEntri::class);
    }

    public function biayaPenyusutan()
    {
        return $this->hasOne(AkunBiayaPenyusutan::class, 'akun_id');
    }
}
