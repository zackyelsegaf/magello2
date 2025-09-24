<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table;
    public $timestamps = false;
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('laravolt.indonesia.table_prefix') . 'villages';
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
}