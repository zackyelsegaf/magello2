<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPersyaratanKonsumen extends Model
{
    /** @use HasFactory<\Database\Factories\MasterPersyaratanKonsumenFactory> */
    use HasFactory;

    protected $table = 'master_persyaratan_konsumens';

    protected $guarded = ['id'];
}
