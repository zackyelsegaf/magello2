<?php

namespace App\Models\ModulUtama\Penjualan;

use App\Models\Base\BaseModel;
use App\Models\User;

class PenawaranPenjualan extends BaseModel
{
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(PenawaranPenjualanItem::class);
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

}
