<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyusutan extends Model
{
    use HasFactory;
    protected $table = 'penyusutan';
    protected $fillable = [
        'nama_penyusutan',
    ];
}
