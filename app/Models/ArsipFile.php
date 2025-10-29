<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipFile extends Model
{
    protected $table = 'arsip_files';
    protected $guarded = [];

    public function arsipmultimenu()
    {
        return $this->morphTo();
    }

    // public function url(): string
    // {
    //     return Storage::disk($this->disk ?? 'public')->url($this->file_path);
    // }
}