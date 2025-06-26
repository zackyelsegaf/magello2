<?php

namespace App\Models\ModulUtama\Aktiva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunAktiva extends Model
{
    /** @use HasFactory<\Database\Factories\AkunAktivaFactory> */
    use HasFactory;

    protected $table = 'akun_aktivas';

    protected $guarded = ['id'];
    
}
