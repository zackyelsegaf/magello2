<?php

namespace App\Models\ModulUtama\Penjualan;

use App\Models\User;
use App\Models\Base\BaseModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\ModulUtama\Penjualan\PenawaranPenjualanItem;
use App\Models\Pelanggan;

class PenawaranPenjualan extends BaseModel
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
        return 'PN';
    }

    protected static function getNoColumn(): string
    {
        return 'no_penawaran';
    }

    protected function tglPenawaran(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m/d/Y'),
        );
    }
}
