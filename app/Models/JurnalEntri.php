<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalEntri extends Model
{
    /** @use HasFactory<\Database\Factories\JurnalEntriFactory> */
    use HasFactory;

    protected $table = 'jurnal_entris';
    protected $guarded = ['id'];

     public function journal()
    {
        return $this->belongsTo(Jurnal::class);
    }

    public function account()
    {
        return $this->belongsTo(Akun::class);
    }

    public function department()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function project()
    {
        return $this->belongsTo(Proyek::class);
    }
}
