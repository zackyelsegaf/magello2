<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RabRapItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RabRap extends Model
{
    use HasFactory;

    protected $table = 'rap_rab';
    protected $fillable = [
        'judul_rap',
        'cluster',
        'persen_kenaikan_qty',
        'tipe_model',
        'total_rap',
        'total_rab',
    ];

    public function rincian()
    {
        return $this->hasMany(RabRapItems::class);
    }

    public function detail()
    {
        return $this->hasMany(RabRapItems::class, 'rap_rab_id', 'id');

    }

    public function detail2()
    {
        return $this->hasOne(RabRapItems::class, 'rap_rab_id', 'id');

    }
}
