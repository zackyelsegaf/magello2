<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RabRap;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RabRapItems extends Model
{
    use HasFactory;
    
    protected $table = 'rap_rab_items';
    protected $fillable = [
        'rap_rab_id',
        'nama_item',
        'satuan',
        'rap_qty',
        'persen_naik',
        'rab_qty',
        'harga_item',
        'total_rap_item',
        'total_rab_item',
    ];

    public function rincian()
    {
        return $this->belongsTo(RabRap::class);
    }
}
