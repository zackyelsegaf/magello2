<?php

namespace App\Models\ModulUtama\Penjualan;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Base\BaseModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ReturPenjualan extends BaseModel
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
        return 'no_retur';
    }

    protected function tglPengiriman(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m/d/Y'),
        );
    }
}