<?php

namespace App\Models\ModulUtama\Penjualan;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PenerimaanPenjualan extends BaseModel
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
        return 'SN';
    }

    protected static function getNoColumn(): string
    {
        return 'no_formulir';
    }

    protected function tglpenerimaan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m/d/Y'),
        );
    }
}
