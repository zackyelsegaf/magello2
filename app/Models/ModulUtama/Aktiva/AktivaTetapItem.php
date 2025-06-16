<?php

namespace App\Models\ModulUtama\Aktiva;

use App\Models\Akun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktivaTetapItem extends Model
{
    /** @use HasFactory<\Database\Factories\AktivaTetapItemFactory> */
    use HasFactory;

    protected $table = 'aktiva_tetap_items';

    protected $guarded = ['id'];

    public function aktivaTetap()
    {
        return $this->belongsTo(AktivaTetap::class, 'aktiva_tetap_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
