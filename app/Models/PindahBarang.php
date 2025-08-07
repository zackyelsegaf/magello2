<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahBarang extends Model
{
    use HasFactory;

    protected $table = 'pindah_barang';

    protected $fillable = [
        'no_pindah',
        'tgl_pindah',
        'dari_gudang',
        'ke_gudang',
        'dari_alamat',
        'ke_alamat',
        'deskripsi',
        'fileupload_1',
        'fileupload_2',
        'fileupload_3',
        'fileupload_4',
        'fileupload_5',
        'fileupload_6',
        'fileupload_7',
        'fileupload_8',
        ];

    public function rincian()
    {
        return $this->hasMany(PindahBarangDetail::class);
    }

    public function detail()
    {
        return $this->hasOne(PindahBarangDetail::class, 'pindah_barang_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('no_pindah', 'desc')->first();
            $prefix = 'GMP';
            $nextID = $latestUser ? intval(substr($latestUser->no_pindah, strlen($prefix))) : 1;
            $model->no_pindah = $prefix . sprintf("%04d", $nextID);
            while (self::where('no_pindah', $model->no_pindah)->exists()) {
                $nextID++;
                $model->no_pindah = $prefix . sprintf("%04d", $nextID);
            }
        });
    }
}
