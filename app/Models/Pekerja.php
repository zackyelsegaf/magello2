<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    use HasFactory;

    protected $table = 'pekerja_simandor';
    protected $fillable = [
        'nama_pekerja',
        'alamat',
        'no_hp'
    ];
}
