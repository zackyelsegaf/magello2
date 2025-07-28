<?php

namespace App\Models;

use App\Models\Pajak;
use App\Models\Syarat;
use App\Models\Dokumen;
use App\Models\Penjual;
use App\Models\MataUang;
use App\Models\TipePelanggan;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $guarded = ['id'];
    // protected $fillable = [
    //     'pelanggan_id',
    //     'nama_pelanggan',
    //     'tanggal_lahir',
    //     'tempat_lahir',
    //     'agama',
    //     'gender',
    //     'nama_ayah',
    //     'nama_ibu',
    //     'nik_pelanggan',
    //     'npwp_pelanggan',
    //     'nppkp_pelanggan',
    //     'pajak_1_pelanggan',
    //     'pajak_2_pelanggan',
    //     'penjual',
    //     'tipe_pelanggan',
    //     'level_harga_pelanggan',
    //     'diskon_penjualan_pelanggan',
    //     'syarat_pelanggan',
    //     'batas_maks_hutang',
    //     'batas_umur_hutang',
    //     'mata_uang_pelanggan',
    //     'saldo_awal_pelanggan',
    //     'tanggal_pelanggan',
    //     'deskripsi',
    //     'status',
    //     'dihentikan',
    //     'alamat_1',
    //     'alamat_2',
    //     'alamatpajak_1',
    //     'alamatpajak_2',
    //     'negara',
    //     'kota',
    //     'provinsi',
    //     'kode_pos',
    //     'kontak',
    //     'no_telp',
    //     'no_fax',
    //     'email',
    //     'website',
    //     'memo',
    //     'fileupload_1',
    //     'fileupload_2',
    //     'fileupload_3',
    //     'fileupload_4',
    //     'fileupload_5',
    //     'fileupload_6',
    //     'fileupload_7',
    //     'fileupload_7',

    // ];


    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latest = self::orderBy('id', 'desc')->first();
            $prefix = 'GMPCSR-';
            $nextID = $latest ? $latest->id + 1 : 1;
            $model->kode_pelanggan = $prefix . sprintf("%04d", $nextID);
        });
    }

    public function dokumen()
    {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }

    public function tipePelanggan()
    {
        return $this->belongsTo(TipePelanggan::class, 'tipe_pelanggan_id');
    }

    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }
    public function status()
    {
        return $this->belongsTo(StatusPemasok::class, 'status_id');
    }

    /**
     * Polymorphic relation to proyek (could be Proyek, Cluster, Kavling, etc.)
     */
    public function proyek()
    {
        return $this->morphTo();
    }

    public function pajak1()
    {
        return $this->belongsTo(Pajak::class, 'pajak_1_id');
    }

    public function pajak2()
    {
        return $this->belongsTo(Pajak::class, 'pajak_2_id');
    }

    public function syarat()
    {
        return $this->belongsTo(Syarat::class);
    }

    public function mataUang()
    {
        return $this->belongsTo(MataUang::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'provinsi_code', 'code');
    }

    public function kota()
    {
        return $this->belongsTo(City::class, 'kota_code', 'code');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
}
