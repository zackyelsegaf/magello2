<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketKonsumen extends Model
{
    /** @use HasFactory<\Database\Factories\TiketKonsumenFactory> */
    use HasFactory;

    protected $table = 'tiket_konsumens';
    protected $guarded = ['id'];

    // Relasi ke kategori tiket
    public function kategori()
    {
        return $this->belongsTo(KategoriTiketKonsumen::class, 'kategori_id');
    }

    // Relasi dokumen polymorphic
    public function dokumens()
    {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }
}
