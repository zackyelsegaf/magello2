<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table;
    public $timestamps = false;
    protected $guarded = [];

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('laravolt.indonesia.table_prefix') . 'districts';
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_code', 'code');
    }
}