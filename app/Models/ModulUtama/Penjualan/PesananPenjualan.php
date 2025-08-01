<?php

namespace App\Models\ModulUtama\Penjualan;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(PesananPenjualanItem::class);
    }
}
