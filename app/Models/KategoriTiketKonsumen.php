<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTiketKonsumen extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriTiketKonsumenFactory> */
    use HasFactory;
    protected $table = 'kategori_tiket_konsumens';
    protected $guarded = ['id'];

    public function tiket()
    {
        return $this->hasMany(TiketKonsumen::class);
    }
}
