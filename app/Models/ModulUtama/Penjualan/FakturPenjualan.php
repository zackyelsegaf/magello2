<?php

namespace App\Models\ModulUtama\Penjualan;

use App\Models\User;
use Faker\Provider\Base;
use App\Models\Pelanggan;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FakturPenjualan extends BaseModel
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(PenawaranPenjualanItem::class);
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function getNoPrefix(): string
    {
        return 'FK';
    }

    protected static function getNoColumn(): string
    {
        return 'no_faktur';
    }

    // protected function tglPengiriman(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::parse($value)->format('m/d/Y'),
    //     );
    // }
}
