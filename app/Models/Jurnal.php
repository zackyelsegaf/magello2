<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnals';
    protected $guarded = ['id'];

    public function entries()
    {
        return $this->hasMany(JurnalEntri::class);
    }

    // public function documents()
    // {
    //     return $this->hasMany(JurnalDocument::class);
    // }

    public function dokumen()
    {
        return $this->morphMany(Dokumen::class, 'dokumenable');
    }
}
