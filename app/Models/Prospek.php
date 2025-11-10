<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Prospek extends Model
{
    use HasFactory;
    protected $table = 'prospek';
    protected $casts = [
        'tags' => 'array',
    ];
    protected $fillable = [
        'cluster_id',
        'nama',
        'email',
        'no_hp',
        'ditugaskan_ke',
        'sumber_prospek',
        'warm_meter',
        'tags',
        'status',
    ];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

}
