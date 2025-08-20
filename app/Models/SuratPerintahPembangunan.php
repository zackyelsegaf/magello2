<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPerintahPembangunan extends Model
{
    /** @use HasFactory<\Database\Factories\SuratPerintahPembangunanFactory> */
    use HasFactory;

    protected $table = 'surat_perintah_pembangunans';
    protected $guarded = ['id'];

}
