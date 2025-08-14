<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    /** @use HasFactory<\Database\Factories\DokumenFactory> */
    use HasFactory;

    protected $table = 'dokumens';
    protected $guarded = ['id'];

    public function dokumenable()
    {
        return $this->morphTo();
    }
}
