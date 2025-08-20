<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePenyesuaian extends Model
{
    /** @use HasFactory<\Database\Factories\MetodePenyesuaianFactory> */
    use HasFactory;

    protected $table = 'metode_penyesuaians';
    protected $guarded = ['id'];
}
