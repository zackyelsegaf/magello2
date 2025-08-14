<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    /** @use HasFactory<\Database\Factories\PekerjaFactory> */
    use HasFactory;

    protected $table = 'pekerjas';
    protected $guarded = ['id'];
}
