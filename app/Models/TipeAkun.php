<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeAkun extends Model
{
    /** @use HasFactory<\Database\Factories\JurnalFactory> */
    use HasFactory;

    protected $table = 'tipe_akun';
    protected $guarded = ['id'];

    public function akun()
    {
        return $this->hasMany(Akun::class, 'tipe_id');
    }
}
