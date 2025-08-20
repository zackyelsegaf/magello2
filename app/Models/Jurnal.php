<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $table = 'jurnal';
    protected $fillable = [
        'no_jurnal',
        'tanggal',
        'no_cek',
        'sumber',
        'mata_uang_asing',
        'urgent',
        'tindak_lanjut',
        'catatan_pemeriksaan',
        'deskripsi',
        'user_id',
        'cabang',
        'nilai',
        'no_persetujuan',
        'disetujui',
    ];

    public function entries()
    {
        return $this->hasMany(DetailJurnal::class);
    }

    // public function documents()
    // {
    //     return $this->hasMany(JurnalDocument::class);
    // }

    public function dokumen()
    {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }
}
