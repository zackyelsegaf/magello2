<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPembulatan extends Model
{
    /** @use HasFactory<\Database\Factories\NilaiPembulatanFactory> */
    use HasFactory;

    protected $table = 'nilai_pembulatans';
    protected $guarded = ['id'];
}
