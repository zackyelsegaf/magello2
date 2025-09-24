<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table;
    public $timestamps = false;
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('laravolt.indonesia.table_prefix') . 'provinces';
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'province_code', 'code');
    }
}