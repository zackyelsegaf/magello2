<?php

namespace App\Models;

use App\Models\Pajak;
use App\Models\Syarat;
use App\Models\Dokumen;
use App\Models\MataUang;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemasok extends Model
{
    use HasFactory;

    protected $table = 'pemasok';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'pemasok_id',
    //     'nama',
    //     'status',
    //     'kode_pos',
    //     'provinsi',
    //     'kota',
    //     'negara',
    //     'alamat_1',
    //     'alamat_2',
    //     'alamatpajak_1',
    //     'alamatpajak_2',
    //     'kontak',
    //     'no_telp',
    //     'no_fax',
    //     'email',
    //     'website',
    //     'memo',
    //     'fileupload_1',
    //     'dihentikan',
    //     'npwp',
    //     'pajak_1',
    //     'pajak_2',
    //     'syarat',
    //     'mata_uang',
    //     'saldo_awal',
    //     'tanggal',
    //     'deskripsi',
    //     'no_pkp',
    // 'fileupload_2',
    // 'fileupload_3',
    // 'fileupload_4',
    // 'fileupload_5',
    // 'fileupload_6',
    // 'fileupload_7',
    // ];

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('pemasok_id', 'desc')->first();
            $nextID = $latestUser ? intval(substr($latestUser->pemasok_id, 3)) + 1 : 1;
            $model->pemasok_id = 'TB-' . sprintf("%04d", $nextID);

            while (self::where('pemasok_id', $model->pemasok_id)->exists()) {
                $nextID++;
                $model->pemasok_id = 'TB-' . sprintf("%04d", $nextID);
            }
        });
    }

    public function dokumen()
    {
        return $this->morphMany(Dokumen::class, 'dokumenable');
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
        return $this->belongsTo(Syarat::class, 'syarat_id');
    }

    public function mataUang()
    {
        return $this->belongsTo(MataUang::class, 'mata_uang_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'provinsi_code', 'code');
    }

    // Relasi ke kota dari Laravolt
    public function kota()
    {
        return $this->belongsTo(City::class, 'kota_code', 'code');
    }

    public function pesananPembelian(){
        return $this->hasMany(PesananPembelian::class, 'no_pemasok', 'pemasok_id');
    }
    public function penerimaanPembelian(){
        return $this->hasMany(PenerimaanPembelian::class, 'no_pemasok', 'pemasok_id');
    }
    public function fakturPembelian(){
        return $this->hasMany(FakturPembelian::class, 'no_pemasok', 'pemasok_id');
    }
    public function returPembelian(){
        return $this->hasMany(ReturPembelian::class, 'no_pemasok', 'pemasok_id');
    }
}
