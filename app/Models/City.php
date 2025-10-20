<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
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
        $this->table = config('laravolt.indonesia.table_prefix') . 'cities';
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }
}
