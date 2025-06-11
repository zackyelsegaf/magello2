<?php

namespace App\Models\ModulUtama\Penjualan;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;

class PesananPenjualan extends BaseModel
{
    protected $guarded = [];
    protected static function getNoPrefix(): string
    {
        return 'ORD';
    }

    protected static function getNoColumn(): string
    {
        return 'no_pesanan';
    }
}
