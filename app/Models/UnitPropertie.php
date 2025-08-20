<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPropertie extends Model
{
    /** @use HasFactory<\Database\Factories\UnitPropertieFactory> */
    use HasFactory;

    protected $table = 'unit_properties';
    protected $guarded = ['id'];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    // public function rapRab()
    // {
    //     return $this->belongsTo(RapRab::class);
    // }
}
