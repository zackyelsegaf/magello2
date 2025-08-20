<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeBarang extends Model
{
    /** @use HasFactory<\Database\Factories\JurnalFactory> */
    use HasFactory;
    protected $table = 'tipe_barang';
    protected $guarded = ['id'];
}
