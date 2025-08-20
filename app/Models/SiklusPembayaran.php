<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiklusPembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\SiklusPembayaranFactory> */
    use HasFactory;

    protected $table = 'siklus_pembayarans';
    protected $guarded = ['id'];
}
