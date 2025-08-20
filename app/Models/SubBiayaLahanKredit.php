<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBiayaLahanKredit extends Model
{
    /** @use HasFactory<\Database\Factories\SubBiayaLahanKreditFactory> */
    use HasFactory;

    protected $table = 'sub_biaya_lahan_kredits';
    protected $guarded = ['id'];
}
