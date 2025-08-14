<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberNilaiAsal extends Model
{
    /** @use HasFactory<\Database\Factories\SumberNilaiAsalFactory> */
    use HasFactory;

    protected $table = 'sumber_nilai_asals';
    protected $guarded = ['id'];
}
